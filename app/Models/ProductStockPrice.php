<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStockPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'id');
    }
    public function linkVariant()
    {
        return $this->belongsTo(LinkVariant::class, 'productGroupId','id');
    }
   
}
