<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPajak extends Model
{
    use HasFactory;
    
    protected $table = 'jenis_pajak';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['kode_pajak', 'jenis_kategori', 'tarif_pajak'];

    public function laporanPajak()
    {
        return $this->hasMany(LaporPajak::class, 'id_kategori');
    }
}
