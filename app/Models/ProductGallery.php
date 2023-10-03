<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = ['productGroupId', 'productGallery'];

    public function linkVariant()
    {
        return $this->hasMany(LinkVariant::class, 'productGroup','productGroupId');
    }
}
