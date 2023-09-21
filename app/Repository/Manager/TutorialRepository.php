<?php
namespace App\Repository\Manager;

use App\Models\Country;
use App\Models\CountryStep;
use App\Models\Tutorial;
use App\Repository\RepositoryRessource;

class TutorialRepository extends RepositoryRessource
{

    public function __construct(Tutorial $model)
    {
        $this->model = $model;
     }

    public function getFlagUrlAndNameOfCountriesWithSteps()
    {
        return CountryStep::join('countries', 'country_steps.country_id', '=', 'countries.id')
            ->selectRaw('country_steps.country_id as id, flag_url,name',)->groupBy('name','flag_url','country_steps.country_id')->orderBy('name')->get();
    }

    public function getCountryStepsAndTutorialsByCountryId($idCountry)
    {
        return Country::with('countrySteps.tutorials')->where('id', $idCountry)->first(['id', 'name', 'short_name','flag_url']);
    }

    public function getCountryStepsByCountryId($idCountry)
    {
        return Country::with('countrySteps')->where('id', $idCountry)->first(['id', 'name', 'short_name','flag_url']);
    }

    public function getTutosByStepCoutryId($idStepCountry)
    {
        $this->model = new CountryStep();
        return  $this->findOne($idStepCountry)->tutorials->makeHidden(['tutorialable_id','tutorialable_type']);;
    }

    public function findById($idTuto)
    {
        return  $this->findOne($idTuto)->makeHidden(['tutorialable_id','tutorialable_type','created_at']);
    }



}
