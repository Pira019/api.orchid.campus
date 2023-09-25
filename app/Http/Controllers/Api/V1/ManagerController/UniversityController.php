<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
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
            'name' =>'required',
            'city_name' =>'required',
            'country_id' =>'required|integer|exists:countries,id',
        ]);

      return  $findCity = $cityRepository->findOrCreate($request->only('city_name','country_id'));
    }

}
