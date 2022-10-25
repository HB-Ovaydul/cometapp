<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagproduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     *  Product tage
     */
    public function tagproduct()
    {
        return $this->belongsToMany(Product::class);
    }
}
