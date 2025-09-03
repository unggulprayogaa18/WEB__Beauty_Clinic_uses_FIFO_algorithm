<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_antrians', function (Blueprint $table) {
            $table->id();
            // Pastikan kolom ini cocok dengan definisi di tabel 'produk'
            $table->string('id_produk', 20); 
            
            // Kolom lain yang sudah kamu definisikan sebelumnya (nomer_antrian, jumlah_diminta, dll.)
            $table->bigInteger('nomer_antrian')->unsigned()->unique()->comment('Nomor urut antrian global');
            $table->integer('jumlah_diminta');
            $table->date('tanggal_permintaan');
            $table->enum('status', ['pending', 'diproses', 'gagal', 'selesai'])->default('pending');
            $table->text('catatan_gagal')->nullable();
            $table->timestamp('diproses_pada')->nullable();
            $table->timestamps();

            // Definisi Foreign Key yang BENAR
            // Referensi ke tabel 'produk' (tanpa 's')
            $table->foreign('id_produk')
                  ->references('id_produk') // Kolom primary key di tabel 'produk'
                  ->on('produk')           // Nama tabel yang dirujuk (tanpa 's')
                  ->onDelete('cascade');    // Aksi saat data di tabel 'produk' dihapus

            $table->index(['status', 'tanggal_permintaan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_antrians');
    }
};