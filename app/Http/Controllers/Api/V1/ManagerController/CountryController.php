<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Manager\GetCountriesWithDisciplanariesResource;
use App\Repository\Manager\CountryRepository;
use App\Repository\Manager\DisciplinarySectorRepository;

class CountryController extends Controller
{
    public function __construct(public CountryRepository $countryRepository,public DisciplinarySectorRepository $disciplinarySectorRepository)
    {}

    public function getCountriesWithUniversities()
    {
        return $this->countryRepository->countriesWithUniversities();
    }

    public function getCountriesWhereStep()
    {
     return $this->countryRepository->getCoutriesAndDisciplinaries();
        return  GetCountriesWithDisciplanariesResource::collection($this->countryRepository->getCoutriesAndDisciplinaries());
    }

}
