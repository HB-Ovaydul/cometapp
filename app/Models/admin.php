<?php

namespace App\Models;

use App\Models\admin\role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class admin extends User
{
    use HasFactory,Notifiable;
    protected $guarded = [];

    /**
     * Get User Role
     */
    public function role()
    {
     return  $this->belongsTo(role::class, 'role_id','id');
    }
    
}
