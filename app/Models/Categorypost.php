<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorypost extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Post Tag Relationship 
    public function catposts()
    {
        return $this->belongsToMany(Post::class);
    }
}
