<?php
namespace App\Repository;

use App\Models\Country;
use App\Repository\RepositoryRessource;

class CountryRepository extends RepositoryRessource {
    public function __construct(Country $model){
        $this->model = $model;
    }

    public function getCoutryList($columns=['*']){
        return  $this->getAll($columns);
    }

    public function getCitiesByCountryId($countryId){
        return $this->findOne($countryId)?->cities()?->select('id','name')->orderBy('name')->get();
    }
}
