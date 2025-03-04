<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporPajak;
use App\Models\PajakKaryawan;
use App\Models\Perusahaan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $total_laporan = LaporPajak::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $total_perusahaan = Perusahaan::count();
        $total_karyawan = PajakKaryawan::count();

        return view('dashboard', compact(
            'total_laporan',
            'total_perusahaan',
            'total_karyawan',
        ));
    }
}
