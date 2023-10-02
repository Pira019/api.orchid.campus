<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUniversityRequest;
use App\Repository\Manager\CityRepository;
use App\Service\ManagerService\UniversityService;

class UniversityController extends Controller
{
    public function __construct(public UniversityService $universityService)
    {}

    public function save(SaveUniversityRequest $request, CityRepository $cityRepository)
    {
       $request->validated();

        $findCity = $cityRepository->findOrCreate($request->only('city_name', 'country_id'));
        return $this->universityService->save($findCity, $request->all());
    }

}

