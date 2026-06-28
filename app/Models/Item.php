<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi
    protected $fillable = ['item_name', 'price', 'stock', 'category_id'];

    // Relasi: Satu item dimiliki oleh satu kategori (Belongs To)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}