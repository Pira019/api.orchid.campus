<?php
namespace App\Service\ManagerService;

use App\Models\CountryStep;
use App\Repository\RepositoryRessource;
use App\Service\ServiceRessource;

class CountryStepService extends ServiceRessource{

    public function __construct(CountryStep $model){
        $this->model = $model;
    }

    public function insertSteps(array $data){
        return $this->insertOrIgnore($data);
    }

   public function deleteStep($idStepCountry){
    $repo = new RepositoryRessource();
    $repo->model = $this->model;

    $countryStepToDeleteId = $repo->getFirst("id",$idStepCountry);

    $countryStepToDeleteId->delete();

    $this->model->where("country_id",$countryStepToDeleteId->country_id)->where("order",">",$countryStepToDeleteId->order)->decrement("order");

    }
}
