<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\CountryStepsRepository;

class CountryStepController extends Controller
{
    public function __construct(public CountryStepsRepository $countryStepsRepository)
    {}

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

}
