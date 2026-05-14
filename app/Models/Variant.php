<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan pengisian data otomatis
    protected $fillable = [
        'product_id', 
        'name', 
        'description', 
        'processor', 
        'memory', 
        'storage'
    ];

    // (Opsional) Relasi kebalikan dari Varian ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}