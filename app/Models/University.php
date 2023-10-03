<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class University extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'shortName','webSite','nameMinicip'];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
