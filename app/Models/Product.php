<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price']; 

    // Menandakan bahwa satu Product bisa memiliki banyak Variant
    public function variants() {
        return $this->hasMany(Variant::class);
    }
}