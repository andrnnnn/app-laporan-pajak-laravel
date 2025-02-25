<?php

namespace App\Http\Controllers;

use App\Models\PajakKaryawan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PajakKaryawanController extends Controller
{
    // Menampilkan daftar pajak karyawan
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PajakKaryawan::with('perusahaan:id_perusahaan,nama_perusahaan')
                ->select(['id_karyawan', 'id_perusahaan', 'npwp', 'nama_karyawan', 'alamat', 'penghasilan', 'status_pajak'])
                ->latest();

            // Tambahkan filter berdasarkan perusahaan jika ada di request
            if ($request->has('perusahaan_id') && !empty($request->perusahaan_id)) {
                $data->where('id_perusahaan', $request->perusahaan_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_perusahaan', function ($row) {
                    return $row->perusahaan->nama_perusahaan ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('pajak-karyawan.edit', $row->id_karyawan) . '" class="btn btn-warning btn-sm">Edit</a>
                            <form action="' . route('pajak-karyawan.destroy', $row->id_karyawan) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus?\')">Hapus</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Ambil semua perusahaan untuk dropdown filter
        $perusahaans = Perusahaan::all();

        return view('pajakkaryawan.index', compact('perusahaans'));
    }

    // Menyimpan data pajak karyawan ke database
    public function store(Request $request)
    {
        $request->validate([
            'npwp' => 'required|unique:pajak_karyawan',
            'nama_karyawan' => 'required',
            'id_perusahaan' => 'required|exists:perusahaan,id_perusahaan',
            'alamat' => 'required',
            'penghasilan' => 'required|numeric',
            'status_pajak' => 'required|in:Wajib Pajak,Tidak Wajib Pajak',
        ]);

        PajakKaryawan::create($request->only([
            'id_perusahaan',
            'npwp',
            'nama_karyawan',
            'alamat',
            'penghasilan',
            'status_pajak'
        ]));

        return redirect()->route('pajak-karyawan.index')->with('success', 'Data pajak karyawan berhasil ditambahkan.');
    }

    // Menampilkan form edit pajak karyawan
    public function edit($id_karyawan)
    {
        $pajakKaryawan = PajakKaryawan::findOrFail($id_karyawan);
        $perusahaans = Perusahaan::all();
        return view('pajakkaryawan.partials.form-edit-pajak-karyawan', compact('pajakKaryawan', 'perusahaans'));
    }

    // Update data pajak karyawan
    public function update(Request $request, $id_karyawan)
    {
        $request->validate([
            'npwp' => 'required|unique:pajak_karyawan,npwp,' . $id_karyawan . ',id_karyawan',
            'nama_karyawan' => 'required',
            'id_perusahaan' => 'required|exists:perusahaan,id_perusahaan',
            'alamat' => 'required',
            'penghasilan' => 'required|numeric',
            'status_pajak' => 'required|in:Wajib Pajak,Tidak Wajib Pajak',
        ]);

        $pajakKaryawan = PajakKaryawan::findOrFail($id_karyawan);
        $pajakKaryawan->update($request->only([
            'id_perusahaan',
            'npwp',
            'nama_karyawan',
            'alamat',
            'penghasilan',
            'status_pajak'
        ]));

        return redirect()->route('pajak-karyawan.index')->with('success', 'Data pajak karyawan berhasil diperbarui.');
    }

    // Hapus data pajak karyawan
    public function destroy($id_karyawan)
    {
        PajakKaryawan::findOrFail($id_karyawan)->delete();
        return redirect()->route('pajak-karyawan.index')->with('success', 'Data pajak karyawan berhasil dihapus.');
    }
}
