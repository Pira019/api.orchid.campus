<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\CountryStepsRepository;

class CountryStepController extends Controller
{
    public function __construct(public CountryStepsRepository $countryStepsRepository){}

    public function getCountriesToAddTuto(){
        return $this->countryStepsRepository->getCountriesToAddTuto();
    }


}
