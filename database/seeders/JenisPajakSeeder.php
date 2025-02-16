<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPajakSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis_pajak')->insert([
            [
                'kode_pajak' => 'PPh21',
                'jenis_kategori' => 'Pajak Penghasilan Pasal 21',
                'tarif_pajak' => 5.00
            ],
            [
                'kode_pajak' => 'PPh23',
                'jenis_kategori' => 'Pajak Penghasilan Pasal 23',
                'tarif_pajak' => 2.00
            ]
        ]);
    }
}