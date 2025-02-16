<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PajakKaryawanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pajak_karyawan')->insert([
            // Karyawan PT Indofood
            [
                'id_perusahaan' => 1, 
                'npwp' => '12.345.678.9-001.000',
                'nama_karyawan' => 'Budi Santoso',
                'alamat' => 'Jl. Ahmad Yani No. 12, Jakarta',
                'tanggal_pembayaran' => '2024-02-01',
                'penghasilan' => 7000000,
                'pajak_terpotong' => 700000 * 5 / 100,
                'status_pajak' => 'Kena Pajak'
            ],
            [
                'id_perusahaan' => 1, 
                'npwp' => '12.345.678.9-002.000',
                'nama_karyawan' => 'Andi Wijaya',
                'alamat' => 'Jl. Diponegoro No. 45, Jakarta',
                'tanggal_pembayaran' => '2024-02-01',
                'penghasilan' => 8000000,
                'pajak_terpotong' => 8000000 * 5 / 100,
                'status_pajak' => 'Kena Pajak'
            ],
            [
                'id_perusahaan' => 1, 
                'npwp' => '12.345.678.9-003.000',
                'nama_karyawan' => 'Citra Lestari',
                'alamat' => 'Jl. Merdeka No. 23, Jakarta',
                'tanggal_pembayaran' => '2024-02-01',
                'penghasilan' => 10000000,
                'pajak_terpotong' => 10000000 * 10 / 100,
                'status_pajak' => 'Kena Pajak'
            ],

            // Karyawan PT Pertamina
            [
                'id_perusahaan' => 2, 
                'npwp' => '98.765.432.1-001.000',
                'nama_karyawan' => 'Siti Aisyah',
                'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta',
                'tanggal_pembayaran' => '2024-02-01',
                'penghasilan' => 12000000,
                'pajak_terpotong' => 12000000 * 10 / 100,
                'status_pajak' => 'Kena Pajak'
            ],
            [
                'id_perusahaan' => 2, 
                'npwp' => '98.765.432.1-002.000',
                'nama_karyawan' => 'Rizky Ramadhan',
                'alamat' => 'Jl. Sudirman No. 99, Jakarta',
                'tanggal_pembayaran' => '2024-02-01',
                'penghasilan' => 9500000,
                'pajak_terpotong' => 9500000 * 5 / 100,
                'status_pajak' => 'Kena Pajak'
            ],
            [
                'id_perusahaan' => 2, 
                'npwp' => '98.765.432.1-003.000',
                'nama_karyawan' => 'Lina Marlina',
                'alamat' => 'Jl. Thamrin No. 5, Jakarta',
                'tanggal_pembayaran' => '2024-02-01',
                'penghasilan' => 8500000,
                'pajak_terpotong' => 8500000 * 5 / 100,
                'status_pajak' => 'Kena Pajak'
            ]
        ]);
    }
}
