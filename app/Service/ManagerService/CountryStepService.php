<?php
namespace App\Service\ManagerService;

use App\Models\CountryStep;
use App\Service\ServiceRessource;

class CountryStepService extends ServiceRessource{

    public function __construct(CountryStep $model){
        $this->model = $model;
    }

    public function insertSteps(array $data){ 
        return $this->insert($data);
    }
}
