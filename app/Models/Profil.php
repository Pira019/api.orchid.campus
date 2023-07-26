<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'desc'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class,"profil_roles");
    }

}
