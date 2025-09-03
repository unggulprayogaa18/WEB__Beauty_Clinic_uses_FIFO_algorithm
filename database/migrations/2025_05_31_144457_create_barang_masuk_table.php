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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->string('id_masuk', 50)->primary();
            $table->string('id_produk', 20);
            $table->integer('jumlah');
            $table->date('tanggal_masuk');
            $table->date('tanggal_kedaluwarsa')->nullable(); // Nullable jika tidak selalu ada
            $table->timestamps(); // Kolom created_at dan updated_at

            // Definisi Foreign Key
            // Pastikan tabel 'produks' dan kolom 'id_produk' sudah ada sebelum menjalankan migrasi ini
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
            // onDelete('cascade') berarti jika produk dihapus, data barang_masuk terkait juga akan terhapus.
            // Ganti dengan onDelete('restrict') atau onDelete('set null') jika perilakunya berbeda.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};