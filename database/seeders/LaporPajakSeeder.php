<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporPajakSeeder extends Seeder
{
    public function run()
    {
        DB::table('lapor_pajak')->insert([
            // Laporan Pajak PT Indofood
            [
                'id_data' => 1,
                'id_kategori' => 1,
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'potongan' => 700000 * 5 / 100,
                'total_penghasilan' => 7000000 - (7000000 * 5 / 100)
            ],
            [
                'id_data' => 2,
                'id_kategori' => 1,
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'potongan' => 8000000 * 5 / 100,
                'total_penghasilan' => 8000000 - (8000000 * 5 / 100)
            ],
            [
                'id_data' => 3,
                'id_kategori' => 1,
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'potongan' => 10000000 * 10 / 100,
                'total_penghasilan' => 10000000 - (10000000 * 10 / 100)
            ],

            // Laporan Pajak PT Pertamina
            [
                'id_data' => 4,
                'id_kategori' => 1,
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'potongan' => 12000000 * 10 / 100,
                'total_penghasilan' => 12000000 - (12000000 * 10 / 100)
            ],
            [
                'id_data' => 5,
                'id_kategori' => 1,
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'potongan' => 9500000 * 5 / 100,
                'total_penghasilan' => 9500000 - (9500000 * 5 / 100)
            ],
            [
                'id_data' => 6,
                'id_kategori' => 1,
                'bulan_pajak' => 2,
                'tahun_pajak' => 2024,
                'potongan' => 8500000 * 5 / 100,
                'total_penghasilan' => 8500000 - (8500000 * 5 / 100)
            ]
        ]);
    }
}
