<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Biar kolom 'name' dan 'description' bisa diisi pas create/update
    protected $fillable = ['name', 'description'];

    // Relasi: Satu kategori punya banyak item (One to Many)
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}