<?php
namespace App\Repository\Manager;

use App\Models\CountryStep;

class TutorialRepository
{

    public function __construct()
    {

    }

    public function getFlagUrlAndNameOfCountriesWithSteps()
    {
        return CountryStep::join('countries', 'country_steps.country_id', '=', 'countries.id')
            ->selectRaw('country_steps.country_id as id, flag_url,name',)->groupBy('name','flag_url','country_steps.country_id')->orderBy('name')->get();
    }


}
