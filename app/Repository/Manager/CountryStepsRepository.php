<?php
namespace App\Repository\Manager;

use App\Models\Country;
use App\Models\CountryStep;
use App\Repository\RepositoryRessource;
use App\Service\CountryService;

class CountryStepsRepository extends RepositoryRessource
{

    public function __construct(CountryStep $model)
    {
        $this->model = $model;
    }
    /**
     * get list of country to add new tuto
     */
    public function getCountriesToAddTuto()
    {
        return $this->model->Rightjoin('countries', 'country_steps.country_id', '=', 'countries.id')
            ->whereNull('country_steps.country_id')->select('countries.id', 'countries.short_name', 'countries.name')->OrderBy('countries.short_name')->get();
    }

    public function getCountriesWithSteps()
    {
        return $this->model->join('countries', 'country_steps.country_id', '=', 'countries.id')
            ->selectRaw('count(country_steps.id) as number_of_steps,name, country_steps.country_id as id, flag_url')->groupBy('country_steps.country_id', 'name','flag_url')->orderBy('name')->get();
    }

    public function getByCountry($idCountry)
    {
        return Country::with('countrySteps')->where('id', $idCountry)->first(['id', 'name', 'short_name']);
    }
    public function getLastId($country_id)
    {
        return $this->model::where("country_id", $country_id)->latest('id')->first()?->id;
    }

    public function getNewSteps($country_id, $lastId)
    {

        if (!$lastId) {
            $newStep = $this->model->where("country_id", $country_id)->select("*")->get()->makeHidden(["created_at", "updated_at"]);
            //put country flag
            if ($newStep) {
                CountryService::addFlagSvgImgToCountry($newStep[0]->country_id);
            }
            return $newStep;
        }
        return $this->model->where("country_id", $country_id)->where("id", ">", $lastId)->select("*")->get()->makeHidden(["created_at", "updated_at"]);
    }

    public function getTutosByStepCoutryId($idStepCountry)
    {
         $authUser_name = auth()->user()->user_name;
        return $this->findOne($idStepCountry)
        ->load(['tutorials.extraTutos' => function($query) use($authUser_name) {
            $query->leftJoin('video_accesses', function($join) use($authUser_name) {
                $join->on('extra_tutorials.id', '=', 'video_accesses.extra_tutorial_id')
                    ->where('extra_tutorials.isPrivate', true)
                    ->where('video_accesses.user_name', $authUser_name);
            })->select("id","tutorial_id",'link_video as token','signature','comment','isPrivate','creator','visibility',"extra_tutorials.updated_at");
        }])
        ->tutorials
        ->makeHidden(['tutorialable_id', 'tutorialable_type','created_at']);
    }

}
