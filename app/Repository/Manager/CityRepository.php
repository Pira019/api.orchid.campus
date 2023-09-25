<?php
namespace App\Repository\Manager;

use App\Models\City;
use App\Repository\RepositoryRessource;

class CityRepository extends RepositoryRessource
{

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function findOrCreate($data)
    {
         $data['name'] = $data['city_name'];
         unset($data['city_name']);  //prepared data
        return $this->firstOrCreate($data);
    }

}
