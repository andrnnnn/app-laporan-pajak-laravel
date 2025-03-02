<?php

namespace App\Http\Controllers;

use App\Models\LaporPajak;
use App\Models\PajakKaryawan;
use App\Models\JenisPajak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporPajakController extends Controller
{
    // Menampilkan daftar laporan pajak
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LaporPajak::with(['karyawan', 'jenisPajak'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('lapor-pajak.show', $row->id_laporan) . '" class="btn btn-info btn-sm">Lihat</a>
                            <a href="' . route('lapor-pajak.print', $row->id_laporan) . '" class="btn btn-success btn-sm">Cetak</a>
                            <form action="' . route('lapor-pajak.destroy', $row->id_laporan) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus laporan ini?\')">Hapus</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('laporpajak.index');
    }

    // Menampilkan form pembuatan laporan pajak
    public function create()
    {
        $karyawan = PajakKaryawan::all();
        $jenisPajak = JenisPajak::all();
        return view('laporpajak.partials.modal-form-add-lapor-pajak', compact('karyawan', 'jenisPajak'));
    }

    // Menyimpan laporan pajak ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:pajak_karyawan,id_karyawan',
            'id_jenis_pajak' => 'required|exists:jenis_pajak,id_jenis_pajak',
            'bulan_pajak' => 'required',
            'tahun_pajak' => 'required',
            'tanggal_pembayaran' => now(),
        ]);

        // Ambil data penghasilan karyawan dan tarif pajak
        $karyawan = PajakKaryawan::findOrFail($request->id_karyawan);
        $jenisPajak = JenisPajak::findOrFail($request->id_jenis_pajak);
        $penghasilan = $karyawan->penghasilan;
        $potongan = ($jenisPajak->tarif / 100) * $penghasilan;
        $penghasilanBersih = $penghasilan - $potongan;

        LaporPajak::create([
            'id_karyawan' => $request->id_karyawan,
            'id_jenis_pajak' => $request->id_jenis_pajak,
            'bulan_pajak' => $request->bulan_pajak,
            'tahun_pajak' => $request->tahun_pajak,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'potongan' => $potongan,
            'penghasilan_bersih' => $penghasilanBersih,
        ]);

        return redirect()->route('lapor-pajak.index')->with('success', 'Laporan pajak berhasil dibuat.');
    }

    // Menampilkan detail laporan pajak
    public function show($id)
    {
        $laporPajak = LaporPajak::with(['karyawan', 'jenisPajak'])->findOrFail($id);
        return view('laporpajak.show', compact('laporPajak'));
    }

    // Fungsi cetak laporan pajak
    public function print($id)
    {
        $laporPajak = LaporPajak::with(['karyawan', 'jenisPajak'])->findOrFail($id);
        return view('laporpajak.cetak', compact('laporPajak'));
    }

    // Hapus laporan pajak
    public function destroy($id)
    {
        LaporPajak::findOrFail($id)->delete();
        return redirect()->route('lapor-pajak.index')->with('success', 'Laporan pajak berhasil dihapus.');
    }
}
