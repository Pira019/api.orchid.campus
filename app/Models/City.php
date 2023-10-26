<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id'];

    public function universties(): HasMany
    {
        return $this->hasMany(University::class);
    }

    public function country(): BelongsTo
    {
        return $this->BelongsTo(Country::class);
    }
}
