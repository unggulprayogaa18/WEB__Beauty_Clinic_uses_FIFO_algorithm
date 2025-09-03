<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) { // saya sesuaikan nama tabel menjadi 'barang_keluar' (snake_case)
            $table->string('id_keluar', 50)->primary();
            $table->string('id_produk', 20);
            $table->integer('jumlah');
            $table->date('tanggal_keluar');
            $table->timestamps(); // Menambahkan created_at dan updated_at

            // Definisi Foreign Key (opsional, tapi sangat direkomendasikan)
            // Pastikan tabel 'produk' sudah ada dan memiliki kolom 'id_produk'
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluar');
    }
};
