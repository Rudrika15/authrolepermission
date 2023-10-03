<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkVariant extends Model
{
    use HasFactory;

    public function productStockPriceGroup()
    {
        return $this->belongsTo(ProductStockPrice::class,'productGroupId','id');
    }
    public function productStockPrice(){
        return $this->hasMany(ProductStockPrice::class, 'productGroupId','productGroup');
    }
    public function linkVariant(){
        return $this->belongsTo(ProductGallery::class,'productGroupId','id');
    }
}
