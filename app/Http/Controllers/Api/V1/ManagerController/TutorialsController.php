<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\TutorialRepository;

class TutorialsController extends Controller
{
    public function __construct(public TutorialRepository $tutorialRepository)
    {}

    /**
     * @OA\Get(
     *      path="/manager/tutorial/countries",
     *      operationId="getFlagUrlAndNameOfCountriesWithSteps",
     *      tags={"ManagerTutorials"},
     *      summary="List countries with steps",
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
     *          description="Successful",
     *          @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/CountriesTutoResponse")
     *          ),
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


    public function getFlagUrlAndNameOfCountriesWithSteps(){
        return $this->tutorialRepository->getFlagUrlAndNameOfCountriesWithSteps();
    }

}
