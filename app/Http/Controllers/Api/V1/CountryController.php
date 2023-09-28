<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\CountryRepository;

class CountryController extends Controller
{
    public function __construct(public CountryRepository $countryRepository){}
    public function getList(){
        return $this->countryRepository->getCoutryList(["id","name"]);
    }
}
