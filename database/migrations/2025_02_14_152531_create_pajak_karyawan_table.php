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
        Schema::create('pajak_karyawan', function (Blueprint $table) {
            $table->id('id_data');
            $table->foreignId('id_perusahaan')->constrained('perusahaan', 'id_perusahaan')->onDelete('cascade');
            $table->string('npwp', 20)->unique();
            $table->string('nama_karyawan', 100);
            $table->text('alamat');
            $table->date('tanggal_pembayaran');
            $table->decimal('penghasilan', 15, 2);
            $table->decimal('pajak_terpotong', 15, 2);
            $table->enum('status_pajak', ['Kena Pajak', 'Tidak Kena Pajak'])->default('Kena Pajak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajak_karyawan');
    }
};
