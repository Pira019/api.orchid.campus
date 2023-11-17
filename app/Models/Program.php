<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;

    public function disciplineSector() : BelongsTo
    {
        return $this->belongsTo(DisciplinarySector::class);

    }
}
