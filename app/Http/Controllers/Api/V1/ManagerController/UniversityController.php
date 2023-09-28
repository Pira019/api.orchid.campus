<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\CountryRepository;
use App\Repository\Manager\CityRepository;
use App\Service\ManagerService\UniversityService;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function __construct(public UniversityService $universityService)
    {}

    public function save(Request $request, CityRepository $cityRepository)
    {
        $request->validate([
            'name' => 'required|unique:universities',
            'city_name' => 'required',
            'country_id' => 'required|integer|exists:countries,id',
            'webSite' => 'required|url:http,https',
            'shortName' => 'nullable|String',
        ]);

        $findCity = $cityRepository->findOrCreate($request->only('city_name', 'country_id'));
        return $this->universityService->save($findCity, $request->all());
    }

}

