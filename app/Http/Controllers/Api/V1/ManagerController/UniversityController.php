<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUniversityAdresseRequest;
use App\Http\Requests\SaveUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Repository\Manager\CityRepository;
use App\Repository\Manager\UniversityRepository;
use App\Service\ManagerService\AddressService;
use App\Service\ManagerService\UniversityService;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function __construct(public UniversityService $universityService, public UniversityRepository $universityRepository)
    {}

    public function save(SaveUniversityRequest $request, CityRepository $cityRepository)
    {
        $request->validated();

        $findCity = $cityRepository->findOrCreate($request->only('city_name', 'country_id'));
        return $this->universityService->save($findCity, $request->all());
    }

    public function update(UpdateUniversityRequest $request, CityRepository $cityRepository)
    {
        $request->validated();

        // Find or create the city
        $idCity = $cityRepository->findOrCreate($request->only(['city_name', 'country_id']))->id;

        $this->universityService->edit($idCity, $request->except(['city_name', 'country_id']));

         // Retrieve and return the updated university
        return $this->universityRepository->findById($request->id);
    }

    public function addAddress(AddUniversityAdresseRequest $request)
    {
        $request->validated();

        $university = $this->universityRepository->findOne($request['university_id']);

        return $this->universityService->addAddress($university, $request->all());
    }

    public function getUniversitiesByCountryId($countryId, Request $request)
    {
        $request->merge(['country_id' => $countryId]);

        $request->validate([
            'country_id' => 'integer|exists:countries,id',
        ]);

        return $this->universityRepository->getByCountryId($countryId);
    }

    public function show($id, Request $request)
    {
        $request->merge(['university_id' => $request->route('id')]);
        $request->validate([
            'university_id' => 'required|integer|exists:universities,id',
        ]);

        return $this->universityRepository->findById($id); // update step
    }

    public function updateAddress(Request $request,AddressService $addressService)
    {
        $request->merge(['university_id' => $request->route('university_id')]);
        $request->validate([
            'university_id' => 'required|integer|exists:universities,id',
            'adress' => 'required',
            'code_postal' => 'nullable|string',
        ]);

        return $addressService->updateUniversityAddress($request->all());
    }

}
