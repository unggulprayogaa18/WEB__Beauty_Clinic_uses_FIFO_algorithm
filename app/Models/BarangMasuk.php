<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_masuk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_masuk',
        'id_produk',
        'jumlah',
        'tanggal_masuk',
        'tanggal_kedaluwarsa',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_kedaluwarsa' => 'date',
        'jumlah' => 'integer',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
