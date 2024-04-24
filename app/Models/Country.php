<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Country extends Model
{
    use HasFactory;
    use HasRelationships;

    protected $fillable = ['name', 'short_name'];
    
    public function countrySteps(): HasMany
    {
        return $this->hasMany(CountryStep::class)->orderBy('order');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function service(): HasOne
    {
        return $this->hasOne(Service::class);
    }

    public function programs()
    {
        return $this->hasManyDeepFromRelations($this->universities(), (new University())->programs());
    }

    public function disciplinaries()
    {
        return $this->hasManyDeepFromRelations($this->programs(),
            (new Program())
                ->disciplineSector(),
        );
    }

    public function universities()
    {
        return $this->hasManyThrough(University::class, City::class);
    }
}
