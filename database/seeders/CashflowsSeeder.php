<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashflowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashflows = [
            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-1-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-1-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-1-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-1-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 120_000, 'created_at' => '2021-1-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-1-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_000_000, 'created_at' => '2021-1-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-2-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-2-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-2-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-2-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 120_000, 'created_at' => '2021-2-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-2-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_000_000, 'created_at' => '2021-2-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-3-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-3-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-3-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-3-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 120_000, 'created_at' => '2021-3-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-3-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_000_000, 'created_at' => '2021-3-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-4-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-4-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-4-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-4-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-4-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-4-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_200_000, 'created_at' => '2021-4-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-5-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-5-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-5-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-5-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-5-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-5-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_200_000, 'created_at' => '2021-5-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-6-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-6-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-6-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-6-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-6-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-6-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_200_000, 'created_at' => '2021-6-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-7-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-7-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-7-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-7-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-7-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 200_000, 'created_at' => '2021-7-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 2_000_000, 'created_at' => '2021-7-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-8-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-8-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-8-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-8-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-8-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 200_000, 'created_at' => '2021-8-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 2_000_000, 'created_at' => '2021-8-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_550_000, 'created_at' => '2021-9-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-9-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-9-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-9-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 150_000, 'created_at' => '2021-9-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 200_000, 'created_at' => '2021-9-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 2_000_000, 'created_at' => '2021-9-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-10-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-10-10'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-10-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-10-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-10-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-10-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-10-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-11-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-11-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-11-11'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-11-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-11-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-11-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-11-21'],

            ['title' => 'Pemasukan', 'category_id' => 1, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-12-8'],
            ['title' => 'Tagihan Listrik', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-12-9'],
            ['title' => 'Tagihan Air', 'category_id' => 3, 'type' => 0, 'amount' => 500_000, 'created_at' => '2021-12-10'],
            ['title' => 'Tagihan Internet', 'category_id' => 3, 'type' => 0, 'amount' =>500_000, 'created_at' => '2021-12-18'],
            ['title' => 'Biaya Lainnya', 'category_id' => 3, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-12-18'],
            ['title' => 'Belanja Makanan', 'category_id' => 4, 'type' => 0, 'amount' => 100_000, 'created_at' => '2021-12-20'],
            ['title' => 'Bonus Tambahan', 'category_id' => 2, 'type' => 1, 'amount' => 1_500_000, 'created_at' => '2021-12-21'],

        ];

        DB::table('cashflows')->insert($cashflows);
    }
}
