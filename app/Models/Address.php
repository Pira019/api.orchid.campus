<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['adress','code_postal'];

    protected $table = 'addresses';

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }


}
