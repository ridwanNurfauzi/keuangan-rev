<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TargetController extends Controller
{
    public function showSetTargetForm($year)
    {
        $_temp = DB::table('targets')->where('year', '=', $year)->get();
        $data = NULL;
        $edit = false;
        if (count($_temp) > 0) {
            $edit = true;
            $data = Target::where('year', '=', $year)->firstOrFail();
        }

        return view('dashboard.set-target', [
            'year' => $year,
            'data' => $data,
            'edit' => $edit
        ]);
    }

    public function setTarget(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric',
        ]);

        $amountString = implode('-', $request->input('amount'));

        $target = Target::updateOrCreate(
            ['year' => $request->year],
            ['amount' => $amountString]
        );

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengatur target."
        ]);

        return redirect()->route('home');
    }
}
