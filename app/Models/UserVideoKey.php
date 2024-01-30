<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVideoKey extends Model
{
    use HasFactory;

     /* @var bool
     */
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded =[""];
}
