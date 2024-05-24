<?php

namespace App\Imports;

use App\Models\Cashflow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

final class CashflowsImportCSV implements ToCollection, WithHeadingRow
{
    public function collection(Collection $row)
    {
        return new Cashflow([
            'category_id' => $row['category_id'],
            'title' => $row['title'],
            'type' => $row['type'],
            'amount' => $row['amount'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at']
    ]);
    }
}
