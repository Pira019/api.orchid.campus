<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = ['title','order','description'];

    public function tutorialable() : MorphTo{
        return $this->morphTo();
    } 
}
