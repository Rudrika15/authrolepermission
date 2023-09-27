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
}
