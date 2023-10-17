<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class University extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'shortName','webSite','nameMinicip'];

    protected function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    protected function setShortNameAttribute($value)
    {
        $this->attributes['shortName'] = strtoupper($value);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function city(): BelongsTo
    {
        return $this->BelongsTo(City::class);
    }
}
