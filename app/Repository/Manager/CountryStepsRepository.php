<?php
namespace App\Repository\Manager;

use App\Models\CountryStep;
use Illuminate\Support\Facades\DB;

class CountryStepsRepository {

   public function  __construct(public CountryStep $countryStep){

    }
    /**
     * get list of country to add new tuto
    */
    public function getCountriesToAddTuto(){
     return  $this->countryStep->rightjoin('countries','country_steps.country_id','=','countries.id')->get();
    }
}
