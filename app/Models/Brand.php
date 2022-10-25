<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Product RelationShip With Brand
     */
    public function brand_product()
    {
       return $this->belongsToMany(Product::class);
    }
}
