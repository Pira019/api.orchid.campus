<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\TutorialRepository;

class TutorialsController extends Controller
{
    public function __construct(public TutorialRepository $tutorialRepository)
    {}

    public function getFlagUrlAndNameOfCountriesWithSteps(){
        return $this->tutorialRepository->getFlagUrlAndNameOfCountriesWithSteps();
    }

}
