<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('route'); // rute perjalanan
            $table->date('date'); // tanggal keberangkatan
            $table->time('departure_time'); // waktu keberangkatan
            $table->time('arrival_time'); // waktu tiba
            $table->integer('available_seats'); // jumlah kursi tersedia
            $table->decimal('price', 10, 2); // harga tiket
            $table->string('bus_number'); // nomor bus
            $table->string('driver_name'); // nama sopir
            $table->text('notes')->nullable(); // catatan tambahan
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};