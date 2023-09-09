<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CountryStep extends Model
{
    use HasFactory;

    protected $table = "country_steps";

    public function tutorials() : MorphMany{
        return $this->morphMany(Tutorial::class,'tutorialable');
    }
}
