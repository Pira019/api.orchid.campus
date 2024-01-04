<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUniversityAdresseRequest;
use App\Http\Requests\SaveUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Repository\Manager\CityRepository;
use App\Repository\Manager\UniversityRepository;
use App\Service\ManagerService\AddressService;
use App\Service\ManagerService\DisciplinarySectorService;
use App\Service\ManagerService\ProgramService;
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

    public function updateAddress(Request $request, AddressService $addressService)
    {
        $request->merge(['university_id' => $request->route('university_id')]);
        $request->validate([
            'university_id' => 'required|integer|exists:universities,id',
            'adress' => 'required',
            'code_postal' => 'nullable|string',
        ]);

        return $addressService->updateUniversityAddress($request->all());
    }

    public function addOrUpdateProgram(Request $request,$university_id, ProgramService $programService, DisciplinarySectorService $disciplinarySectorService)
    {
        $request->merge(['university_id' => $request->route('university_id')]);

        $request->validate([
            'university_id' => 'required|integer|exists:universities,id',
            'program_name' => 'required|max:255',
            'discipline_name' => 'required|max:255',
            'discipline_description' => 'nullable|string|max:1000',
            //detail
            'nbrCredit' => 'required|integer',
            'cycle' => 'required|integer',
            'duration' => 'required|integer',
            'admission_scheme' => 'required|string|max:255',
            'languages' => 'required|string|max:55',
            'program_description' => 'required|string',
            'isUpdate' => 'nullable|boolean '
        ]);

       $newProgramm = $programService->save($request, $disciplinarySectorService->save($request)->id);
       $university = $this->universityRepository->findById($university_id);

      return $this->universityService->addOrUpdateProgram(
    $university, $newProgramm,
    $request->only(['nbrCredit', 'cycle', 'duration', 'admission_scheme', 'languages', 'program_description']),
    $request->boolean('isUpdate'));

    }

    public function getPrograms(Request $request,$university_id)
    {
        $request->merge(['university_id' => $request->route('university_id')]);

        $request->validate([
            'university_id' => 'required|integer|exists:universities,id'
        ]);

        return $this->universityRepository->getProgramsByUniversityId($university_id);
    }

}
