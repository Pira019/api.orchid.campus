<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function disciplinaries() : BelongsToMany
    {
        return $this->belongsToMany(DisciplinarySector::class,'service_disciplinaries');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function admissionDates(): BelongsToMany
    {
        return $this->belongsToMany(AdmissionDate::class,"service_date_admission");
    }

}
