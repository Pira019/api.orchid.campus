<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\CountryStepsRepository;
use App\Service\ManagerService\CountryStepService;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Http\Request;

class CountryStepController extends Controller
{
    public function __construct(public CountryStepsRepository $countryStepsRepository,public CountryStepService $countryStepService)
    {}

    public function getAll(){
        return $this->countryStepsRepository->getAll();
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
     *      path="/coutry-steps",
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
        return $this->countryStepService->insertSteps($request->all());
    }

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
     *      path="/country/steps/edit/{id}",
     *      operationId="editStep",
     *      tags={"Steps"},
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
        ]);
        return $this->countryStepService->update($request->all(),$step_id);
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
