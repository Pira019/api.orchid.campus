<?php
namespace App\Repository\Manager;

use App\Models\CountryStep;

class CountryStepsRepository
{

    public function __construct(public CountryStep $countryStep)
    {

    }
    /**
     * get list of country to add new tuto
     */
    public function getCountriesToAddTuto()
    {
        return $this->countryStep->Rightjoin('countries', 'country_steps.country_id', '=', 'countries.id')
            ->whereNull('country_steps.country_id')->select('countries.id', 'countries.short_name', 'countries.name')->OrderBy('countries.short_name')->get();
    }

    public function getAll()
    {
        return $this->countryStep->join('countries', 'country_steps.country_id', '=', 'countries.id')
        ->selectRaw('count(country_steps.id) as number_of_steps,name, country_steps.country_id as id')->groupBy('country_steps.country_id','name')->orderBy('name') ->get();
    }
}
