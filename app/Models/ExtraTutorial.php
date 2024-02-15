<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExtraTutorial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function videoAccesses() : HasMany
    {
        return $this->hasMany(VideoAccess::class);
    }
}
