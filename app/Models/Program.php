<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['label','disciplinary_sector_id'];

    public function disciplinarySector():HasOne
    {
        return $this->HasOne(DisciplinarySector::class);
    }
}
