<?php

namespace App\Http\Controllers;

use App\Exports\CashflowsExport;
use App\Models\Cashflow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\CashflowsImportCSV;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class CashflowController extends Controller
{
    public function API_index()
    {
        $cashflow = DB::table('cashflows')->join(
            'categories',
            'cashflows.category_id',
            '=',
            'categories.id'
        )->get([
            'cashflows.id',
            'cashflows.category_id',
            'cashflows.title',
            'cashflows.type',
            'cashflows.amount',
            'cashflows.created_at',
            'cashflows.updated_at',
            'categories.name as category',
        ]);
        return $cashflow;
    }

    public function targets_API() {
        $targets = DB::table('targets')->get();
        return $targets;
    }

    public function index()
    {
        return view('cashflow.index');
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('create-cashflow')) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Anda tidak memiliki akses untuk menambah cashflow."
            ]);

            return redirect('/cashflows');
        }
        return view('cashflow.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasPermission('create-cashflow')) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Anda tidak memiliki akses untuk menambah cashflow."
            ]);

            return redirect('/cashflows');
        }

        $data = new Cashflow();
        $data['title'] = $request['title'];
        $data['category_id'] = $request['category'];
        $data['amount'] = $request['amount'];
        $data['type'] = $request['type'];
        $data['created_at'] = $request['created_at'];
        $data['updated_at'] = null;
        $data->save();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah cashflow"
        ]);

        return redirect()->route('cashflows.index');
    }

    public function show($id)
    {
        $data = Cashflow::findOrFail($id);
        return view('cashflow.show', ['data' => $data, 'category' => Category::find($data['category_id'])]);
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('edit-cashflow')) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Anda tidak memiliki akses untuk mengubah cashflow."
            ]);

            return redirect('/cashflows');
        }

        return view('cashflow.edit', [
            'data' => Cashflow::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermission('edit-cashflow')) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Anda tidak memiliki akses untuk mengubah cashflow."
            ]);

            return redirect('/cashflows');
        }

        $data = Cashflow::findOrFail($id);
        $data['title'] = $request['title'];
        $data['category_id'] = $request['category'];
        $data['amount'] = $request['amount'];
        $data['type'] = $request['type'];
        $data['created_at'] = $request['created_at'];
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengubah cashflow"
        ]);

        return redirect()->route('cashflows.index');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('delete-cashflow')) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Anda tidak memiliki akses untuk menghapus cashflow."
            ]);

            return redirect('/cashflows');
        }

        Cashflow::findOrFail($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menghapus cashflow"
        ]);
        return redirect()->route('cashflows.index');
    }

    public function bulkDestroy(Request $req)
    {
        return DB::table('cashflows')->whereIn('id', $req['data'])->delete();
    }

    public function exportPDF(Request $req)
    {
        $data = DB::table('cashflows')->whereIn('id', $req['data'])->get();
        $pdf = PDF::loadView('cashflow.pdf', compact('data'));

        return $pdf->download('cashflow.pdf');
    }

    public function exportCSV(Request $req)
    {
        return Excel::download(new CashflowsExport($req['data']), 'cashflow.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function importCSV(Request $req)
    {
        if (!Auth::user()->hasPermission('create-cashflow')) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Anda tidak memiliki akses untuk menambah cashflow."
            ]);

            return redirect('/cashflows');
        }

        if ($req->hasFile('csv_file')) {
            $csvFile = $req->file('csv_file');
            $csvFileName = time() . '.' . $csvFile->getClientOriginalExtension();

            $csvFile->move(public_path('uploadsCSV'), $csvFileName);
            $csvData = public_path('uploadsCSV') . '\\' . $csvFileName;

            $data = Excel::toCollection(new CashflowsImportCSV, $csvData, null)[0];

            File::delete($csvData);
            $success = [];

            foreach ($data as $value) {
                if (Category::where('id', $value['category_id'])->exists()) {
                    $nData = new Cashflow();
                    $nData['category_id'] = $value['category_id'];
                    $nData['title'] = $value['title'];
                    $nData['type'] = !!($value['type']);
                    $nData['amount'] = $value['amount'];
                    $nData['created_at'] = $value['created_at'];
                    $nData['updated_at'] = $value['updated_at'];
                    $success[] = true;
                    $nData->save();
                }
            }

            if (count($success) > 0)
                Session::flash("flash_notification", [
                    "level" => "success",
                    "message" => "Berhasil menambah " . count($success) . " cashflow."
                ]);
            else
                Session::flash("flash_notification", [
                    "level" => "warning",
                    "message" => "Tidak ada cashflow yang dapat ditambah."
                ]);

            return redirect()->route('cashflows.index');
        }
    }
}
