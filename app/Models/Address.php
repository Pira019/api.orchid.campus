<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['adress','code_postal','university_id'];

    protected $table = 'addresses';

    protected function setAdressAttribute($value)
    {
        $this->attributes['adress'] = ucfirst(strtolower($value));
    }

    protected function setCodePostalAttribute($value){
        $this->attributes['code_postal'] = strtoupper($value);
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }


}
