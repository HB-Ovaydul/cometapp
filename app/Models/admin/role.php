<?php

namespace App\Models\admin;

use App\Models\admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     *  One To Many 
     * Get User Permissions
     */

     public function users()
     {
      return  $this->hasMany(admin::class, 'role_id', 'id');
     }


}
