<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporPajak extends Model
{
    use HasFactory;
    
    protected $table = 'lapor_pajak';
    protected $primaryKey = 'id_laporan';
    protected $fillable = ['id_data', 'id_kategori', 'bulan_pajak', 'tahun_pajak', 'potongan', 'total_penghasilan'];

    public function karyawan()
    {
        return $this->belongsTo(PajakKaryawan::class, 'id_data');
    }

    public function jenisPajak()
    {
        return $this->belongsTo(JenisPajak::class, 'id_kategori');
    }
}
