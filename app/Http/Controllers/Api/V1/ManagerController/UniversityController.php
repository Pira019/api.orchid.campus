<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUniversityAdresseRequest;
use App\Http\Requests\SaveUniversityRequest;
use App\Repository\Manager\CityRepository;
use App\Repository\Manager\UniversityRepository;
use App\Service\ManagerService\UniversityService;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function __construct(public UniversityService $universityService,public UniversityRepository $universityRepository)
    {}

    public function save(SaveUniversityRequest $request, CityRepository $cityRepository)
    {
       $request->validated();

        $findCity = $cityRepository->findOrCreate($request->only('city_name', 'country_id'));
        return $this->universityService->save($findCity, $request->all());
    }

    public function addAddress(AddUniversityAdresseRequest $request)
    {
        $request->validated();

        $university = $this->universityRepository->findOne($request['university_id']);

        return $this->universityService->addAddress($university,$request->all());
    }

}

