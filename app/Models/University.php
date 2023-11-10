<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class University extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'shortName','webSite','nameMinicip'];

    protected function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function city(): BelongsTo
    {
        return $this->BelongsTo(City::class);
    }

    public function programs() : BelongsToMany
    {
        return $this->belongsToMany(Program::class,'detail_programs');
    }
}
