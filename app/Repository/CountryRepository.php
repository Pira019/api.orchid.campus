<?php
namespace App\Repository;

use App\Models\Country;
use App\Repository\RepositoryRessource;

class CountryRepository extends RepositoryRessource {
    public function __construct(Country $model){
        $this->model = $model;
    }

    public function getCoutryList($collumn=['*']){
        return  $this->getAll($collumn);
    }
}
