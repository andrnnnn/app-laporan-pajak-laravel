<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakKaryawan extends Model
{
    use HasFactory;

    protected $table = 'pajak_karyawan';
    protected $primaryKey = 'id_karyawan'; // Sesuai struktur baru
    protected $fillable = [
        'id_perusahaan',
        'npwp',
        'nama_karyawan',
        'alamat',
        'penghasilan',
        'status_pajak'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    public function laporanPajak()
    {
        return $this->hasMany(LaporPajak::class, 'id_karyawan', 'id_karyawan');
    }
}
