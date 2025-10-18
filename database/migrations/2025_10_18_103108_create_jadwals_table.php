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
    Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        $table->string('rute');
        $table->date('tanggal_keberangkatan');
        $table->time('waktu_keberangkatan');
        $table->integer('jumlah_kursi');
        $table->decimal('harga_tiket', 10, 2);
        $table->string('nama_sopir')->nullable();
        $table->string('nomor_kendaraan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
