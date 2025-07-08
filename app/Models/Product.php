<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'stock'];

    // Add this method to fetch related images
    public function images()
    {
        return $this->hasMany(\App\Models\ProductImage::class);
    }
}
