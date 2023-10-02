<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\CountryStepsRepository;
use App\Service\ManagerService\CountryStepService;
use Illuminate\Http\Request;

class CountryStepController extends Controller
{
    public function __construct(public CountryStepsRepository $countryStepsRepository,public CountryStepService $countryStepService)
    {}

    public function getAll(){
        return $this->countryStepsRepository->getCountriesWithSteps();
    }

    /**
     * @OA\Get(
     *      path="/country-to-add-tuto",
     *      operationId="getCountryToAddTuto",
     *      tags={"Add tuto"},
     *      summary="List countries to add tutoriel or steps",
     *    @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/CountryStepResponse")
     *          ),
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Bad Request"
     *      ),
     *     )
     */
    public function getCountryToAddTuto()
    {
        return $this->countryStepsRepository->getCountriesToAddTuto();
    }

     /**
     * @OA\Post(
     *      path="manager/coutry-steps",
     *      operationId="store",
     *      tags={"Add tuto"},
     *      summary="Add country steps",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *                type="array",
     *                @OA\Items(ref="#/components/schemas/AddCountryStepsRequest")
     * )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *     )
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            '*.title' => 'required|string|max:255',
            '*.order' => 'required|integer',
            '*.country_id' => 'required|integer',
        ]);

        //return new stpes stored
       $country_id = $request->all()[0]['country_id'];//get country id
       $lastId = $this->countryStepsRepository->getLastId($country_id) ?? false;

       $this->countryStepService->insertSteps($request->all());
       return $this->countryStepsRepository->getNewSteps($country_id,$lastId);  //retun new records
    }

        /**
     * @OA\Get(
     *      path="/manager/country/Steps/{id}",
     *      operationId="findByCountry",
     *      tags={"CountrySteps"},
     *      summary="List steps of a country",
     *      security={{"bearerAuth":{}}, {"XSRF-TOKEN": {}}},
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          required=true,
     *          description="Enter your token here as 'Bearer {your_token_here}'",
     *          example="Bearer your_actual_token_here",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID country",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Header(
     *          header="X-CSRF-Token",
     *          description="Your CSRF Token",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *    @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/StepsOfCountryResponse")
     *
     *
     *       ),
     *    @OA\Response(
     *          response=404,
     *          description="Bad Request"
     *      ),
     *    @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *       ),
     *     )
     */
    public function findByCountry($country_id,Request $request)
    {
        $request->merge(['country_id' => $request->route('id')]);
        $request->validate([
            'country_id' =>
                'required|integer|exists:countries,id',
        ]);
        return $this->countryStepsRepository->getByCountry($country_id);
    }


    /**
     * @OA\Post(
     *      path="manager/country/steps/edit/{id}",
     *      operationId="editStep",
     *      tags={"CountrySteps"},
     *      summary="Edit step",
     *  @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the step to be edited",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/EditStepRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success request"
     *
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Bad Request"
     *      ),
     *     )
     */
    public function editStep($step_id,Request $request)
    {
        $request->merge(['step_id' => $request->route('id')]);
        $request->validate([
            'step_id' =>'required|integer|exists:country_steps,id',
            'order' =>'integer',
        ]);
       return $this->countryStepService->update($request->except("id"),$step_id); // update step
    }

    public function deleteStep($step_id,Request $request)
    {
        $request->merge(['step_id' => $request->route('id')]);
        $request->validate([
            'step_id' =>'required|integer|exists:country_steps,id',
        ]);
        return $this->countryStepService->deleteStep($step_id);
    }

}
