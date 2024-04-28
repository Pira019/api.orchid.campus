<?php
namespace App\Repository\Manager;

use App\Models\Country;
use App\Repository\RepositoryRessource;

class CountryRepository extends RepositoryRessource
{

    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    public function countriesWithUniversities()
    {
        return $this->model->whereHas('cities.universties')->orderBy('countries.name')->select('id','name')->get();
    }

    public function countriesWhereStep()
    {
        return $this->model->whereHas('countrySteps')->whereHas('cities')->orderBy('countries.name')->select('id','name')->get();
    }

    public function getCoutriesAndDisciplinaries(){
        return $this->model->has('disciplinaries')
        ->with('disciplinaries',fn($query)=> $query->select('disciplinary_sectors.id','disciplinary_sectors.label'))
        ->select('id','name','short_name','flag_url')->get();
    }

}
