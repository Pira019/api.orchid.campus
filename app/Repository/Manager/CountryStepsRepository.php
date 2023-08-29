<?php
namespace App\Repository\Manager;

use App\Models\Country;
use App\Models\CountryStep;
use App\Repository\RepositoryRessource;

class CountryStepsRepository
{

    public function __construct(public CountryStep $countryStep)
    {

    }
    /**
     * get list of country to add new tuto
     */
    public function getCountriesToAddTuto()
    {
        return $this->countryStep->Rightjoin('countries', 'country_steps.country_id', '=', 'countries.id')
            ->whereNull('country_steps.country_id')->select('countries.id', 'countries.short_name', 'countries.name')->OrderBy('countries.short_name')->get();
    }

    public function getCountriesWithSteps()
    {
        return $this->countryStep->join('countries', 'country_steps.country_id', '=', 'countries.id')
        ->selectRaw('count(country_steps.id) as number_of_steps,name, country_steps.country_id as id')->groupBy('country_steps.country_id','name')->orderBy('name') ->get();
    }

    public function getByCountry($idCountry)
    {
        return Country::with('countrySteps')->where('id',$idCountry)->first(['id','name','short_name']);
    }
    public function getLastId($country_id){
    return $this->countryStep::where("country_id",$country_id)->latest('id')->first()?->id;
    }

    public function getNewSteps($country_id,$lastId){
        if(!$lastId){
            return  $this->countryStep->where("country_id",$country_id)->select("*")->get()->makeHidden(["created_at","updated_at"]);;
        }
        return $this->countryStep->where("country_id",$country_id)->where("id",">",$lastId)->select("*")->get()->makeHidden(["created_at","updated_at"]);
        }

}
