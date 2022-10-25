<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

            /**
             *  Product Category Relationship
             */
            public function Pro_cat()
            {
              return $this-> belongsToMany(Categoryproduct::class);
            }
            
            /**
             *  Product Category Relationship
             */
            public function Pro_tag()
            {
              return $this-> belongsToMany(Tagproduct::class);
            }
            /**
             *  Product Category Relationship
             */
            public function Pro_brand()
            {
              return $this-> belongsToMany(Brand::class);
            }

}
