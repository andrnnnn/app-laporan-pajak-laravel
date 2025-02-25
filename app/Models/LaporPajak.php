<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporPajak extends Model
{
    use HasFactory;

    protected $table = 'lapor_pajak';
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'id_karyawan',
        'id_jenis_pajak',
        'bulan_pajak',
        'tahun_pajak',
        'tanggal_pembayaran',
        'potongan',
        'penghasilan_bersih'
    ];

    public function karyawan()
    {
        return $this->belongsTo(PajakKaryawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function jenisPajak()
    {
        return $this->belongsTo(JenisPajak::class, 'id_jenis_pajak', 'id_jenis_pajak');
    }
}
