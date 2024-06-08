<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'first_name', 'sex', 'birth_date', 'residence_contry', 'citizenship', 'phone'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->BelongsTo(Country::class,'residence_contry');
    }
}
