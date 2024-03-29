<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['label','disciplinary_sector_id'];

    public function disciplineSector() : BelongsTo
    {
        return $this->belongsTo(DisciplinarySector::class);

    }

    public function admissionDate() : HasMany
    {
        return $this->hasMany(AdmissionDate::class,'detail_program_id');
    }

    public function universities() : BelongsToMany
    {
        return $this->belongsToMany(University::class,DetailProgram::class);
    }
}
