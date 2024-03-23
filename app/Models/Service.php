<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function disciplanaries() : BelongsToMany
    {
        return $this->belongsToMany(DisciplinarySector::class,'service_disciplinaries');
    }

}
