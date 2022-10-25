<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoryproduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     *  Product With Category relationship
     */
    public function cat_products()
    {
        return $this->belongsToMany(Product::class);
    }
    /**
     *  Product With Category relationship
     */
    public function category_products()
    {
        return $this->hasMany(Product::class, 'categoryproduct_id','id');
    }
}
