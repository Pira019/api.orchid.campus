<?php
namespace App\Service\ManagerService;

use App\Models\University;
use App\Service\ServiceRessource;

class UniversityService extends ServiceRessource
{

    public function __construct(University $model)
    {
        $this->model = $model;
    }

    public function save($city,$data){
        if(!$city){
            return null;
        }
        return $city->universties()->create($data);
    }


}
