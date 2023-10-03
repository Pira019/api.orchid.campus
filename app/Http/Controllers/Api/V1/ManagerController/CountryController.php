<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\CountryRepository;

class CountryController extends Controller
{
    public function __construct(public CountryRepository $countryRepository)
    {}

    public function getCountriesWithUniversities()
    {
        return $this->countryRepository->countriesWithUniversities();
    }

}
