<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
    protected $fillable = ['name', 'price', 'stock'];

    // Add this method to fetch related images
    public function images()
    {
        return $this->hasMany(\App\Models\ProductImage::class);
    }
=======
    //
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
}
