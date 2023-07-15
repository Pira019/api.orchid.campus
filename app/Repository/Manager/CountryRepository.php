<?php
namespace App\Repository\Manager;

use App\Models\Country;
use App\Repository\RepositoryRessource;

class CountryRepository extends RepositoryRessource
{

    public function __construct(public Country $model)
    {

    }

    public function getCoutrySteps($countryId){
      //  return $this->find()
    }

}
