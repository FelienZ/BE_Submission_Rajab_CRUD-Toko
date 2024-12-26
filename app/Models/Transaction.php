<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
    'product_id', 
    'quantity', 
    'total_price', 
    'product_name', 
    'product_description',
];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
