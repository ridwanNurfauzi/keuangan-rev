<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TargetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targets = [
            ['year' => 2021, 'amount' => '2000000-2300500-4000000-3500000'],
            ['year' => 2022, 'amount' => '2300000-2800500-4000000-3000000'],
            ['year' => 2023, 'amount' => '2005000-2000500-4000000-4500000']
        ];

        DB::table('targets')->insert($targets);
    }
}
