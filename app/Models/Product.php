<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class, 'catId');
    }
    public function productStockPrice(){
        return $this->hasMany(ProductStockPrice::class, 'productId','id');
    }
    public function productGallery(){
        return $this->hasMany(ProductGallery::class, 'productId','id');
    }
}
