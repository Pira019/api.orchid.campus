<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function image() : MorphOne
    {
        return $this->morphOne(Image::class, 'imageable'); 
    }
}
