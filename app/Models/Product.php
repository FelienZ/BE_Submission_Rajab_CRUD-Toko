<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nama tabel (jika berbeda dengan nama model)
    protected $table = 'products';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'Nama_Barang',
        'Harga',
        'Deskripsi',
        'image',
    ];

    // Relasi ke model Transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'product_id');
    }
}
