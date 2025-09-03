<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'barang_keluar'; // Sesuaikan dengan nama tabel di migrasi

    /**
     * Primary key tabel.
     *
     * @var string
     */
    protected $primaryKey = 'id_keluar'; // Primary key Anda bukan 'id'

    /**
     * Menunjukkan apakah primary key auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false; // Karena id_keluar Anda adalah VARCHAR dan bukan auto-increment

    /**
     * Tipe data dari primary key.
     *
     * @var string
     */
    protected $keyType = 'string'; // Karena id_keluar adalah VARCHAR

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_keluar',
        'id_produk',
        'jumlah',
        'tanggal_keluar',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_keluar' => 'date',
        'jumlah' => 'integer',
    ];

    /**
     * Relasi ke model Produk.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}