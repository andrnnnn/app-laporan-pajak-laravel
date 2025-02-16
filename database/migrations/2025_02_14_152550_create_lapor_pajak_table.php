<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lapor_pajak', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_data')->constrained('pajak_karyawan', 'id_data')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('jenis_pajak', 'id_kategori')->onDelete('cascade');
            $table->integer('bulan_pajak');
            $table->integer('tahun_pajak');
            $table->decimal('potongan', 15, 2);
            $table->decimal('total_penghasilan', 15, 2);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapor_pajak');
    }
};
