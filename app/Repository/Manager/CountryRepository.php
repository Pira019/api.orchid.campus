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

}
