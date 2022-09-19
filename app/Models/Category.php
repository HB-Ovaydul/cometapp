<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     *  Many To Many Relationship
     */
    public function portfolios()
    {
        return $this-> belongsToMany(Portfolio::class);
    }
}
