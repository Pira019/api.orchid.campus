<?php
namespace App\Repository\Manager;

use App\Models\University;
use App\Repository\RepositoryRessource;

class UniversityRepository extends RepositoryRessource
{

    public function __construct(University $model)
    {
        $this->model = $model;
    }

    public function getByCountryId($countryId){
        return $this->model->whereHas('city.country',fn( $query) => $query->where('id',$countryId))->orderBy('universities.name')->get();
    }


}
