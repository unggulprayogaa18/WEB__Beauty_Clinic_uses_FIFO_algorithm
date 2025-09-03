<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB; // Uncomment jika menggunakan metode locking yang lebih kompleks untuk nomer_antrian

class DaftarAntrian extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'daftar_antrians';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomer_antrian',
        'id_produk',
        'jumlah_diminta',
        'tanggal_permintaan',
        'status',
        'catatan_gagal',
        'diproses_pada',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_permintaan' => 'date',
        'diproses_pada' => 'datetime',
        'nomer_antrian' => 'integer', // Sesuaikan dengan tipe data di migrasi
    ];

    /**
     * Mendapatkan produk yang terkait dengan entri antrian.
     */
    public function produk()
    {
        // Pastikan 'id_produk' sebagai foreign key di tabel ini,
        // dan 'id_produk' sebagai primary key di tabel 'produk'.
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    /**
     * Metode "booted" dari model.
     * Digunakan untuk mendaftarkan event listener model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($antrian) {
            // Secara otomatis mengisi 'nomer_antrian' jika belum diisi saat pembuatan record baru.
            if (is_null($antrian->nomer_antrian)) {
                // Metode sederhana untuk mendapatkan nomor antrian berikutnya.
                // PERHATIAN: Ini bisa rentan terhadap race conditions pada sistem dengan konkurensi tinggi.
                // Untuk sistem produksi yang sibuk, pertimbangkan solusi yang lebih robust.
                
                // Mengambil nomer_antrian tertinggi yang sudah ada, lalu ditambah 1.
                // Jika belum ada antrian sama sekali, dimulai dari 1.
                $maxAntrian = self::max('nomer_antrian');
                $antrian->nomer_antrian = ($maxAntrian ?? 0) + 1;
            }
        });
    }
}
