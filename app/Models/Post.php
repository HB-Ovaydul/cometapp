<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Post Category Relationship
    public function postcat()
    {
      return $this->belongsToMany(Categorypost::class);
    }

    // Post Tag Relationship 
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
    // Post with Admin Relationship 
    public function author()
    {
        return $this->belongsTo(admin::class, 'admin_id', 'id');
    }
}
