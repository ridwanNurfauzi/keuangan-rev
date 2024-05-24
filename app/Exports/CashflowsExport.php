<?php

namespace App\Exports;

use App\Models\Cashflow;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CashflowsExport implements FromCollection, WithHeadings
{
    protected $ids;
    protected $columns = [
        'category_id',
        'title',
        'type',
        'amount',
        'created_at',
        'updated_at'
    ];

    public function __construct($ids = null) {
        $this->ids = $ids;
    }

    public function collection()
    {
        return DB::table('cashflows')->whereIn('id', $this->ids)->get($this->columns);
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
