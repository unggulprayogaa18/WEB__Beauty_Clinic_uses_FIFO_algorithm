<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_produk',
        'nama_produk',
        'kategori',
    ];
    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'id_produk', 'id_produk');
    }   

    // Anda mungkin juga punya relasi ke BarangKeluar
    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'id_produk', 'id_produk');
    }
}
