<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_name'];

    public function countrySteps() : HasMany{
        return $this->hasMany(CountryStep::class)->orderBy('order');
    }

    public function cities() : HasMany{
        return $this->hasMany(City::class);
    }
}
