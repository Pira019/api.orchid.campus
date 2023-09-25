<?php
namespace App\Service\ManagerService;

use App\Models\City;
use App\Service\ServiceRessource;

class CityService extends ServiceRessource
{

    public function __construct(City $model)
    {
        $this->model = $model;
    }
 

}
