<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\TutorialRepository;
use App\Service\ManagerService\TutorialService;
use App\Service\ManagerService\TutoVideos\CloudflareStreamService;
use Illuminate\Http\Request;

class TutorialsController extends Controller
{
    public function __construct(public TutorialRepository $tutorialRepository, public TutorialService $tutorialService,public CloudflareStreamService $cloudflareStreamService)
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

    public function getCountryStepsByCountryId($country_id,Request $request)
    {
        $request->merge(['country_id' => $request->route('id')]);
        $request->validate([
            'country_id' =>
                'required|integer|exists:countries,id',
        ]);
        return $this->tutorialRepository->getCountryStepsByCountryId($country_id);
    }

    public function save(Request $request)
    {
        $request->validate([
            'step_id' =>'required|integer|exists:country_steps,id',
            'title' =>'required',
            'order' =>'required|integer',
            'description' =>'nullable',
        ]);
      return $this->tutorialService->save($request->all());
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' =>'required|integer|exists:tutorials,id',
            'title' =>'required',
            'description' =>'nullable',
        ]);
      $updated = $this->tutorialService->updateOne($request->only(['title','description']),$request['id']);

      if(!$updated){
        return $request->all();
      }
      return $this->tutorialRepository->findById($request['id']);
    }


    public function getTutosByStepCoutryId($stepCoutrty_id,Request $request){
        $request->merge(['step_country_id' => $request->route('id')]);
        $request->validate([
            'step_country_id' =>
                'required|integer|exists:country_steps,id',
        ]);

        return $this->tutorialRepository->getTutosByStepCoutryId($stepCoutrty_id);
    }

    public function deleteTutoAndReorderOrder($tuto_id,Request $request)
    {
        $request->merge(['tuto_id' => $request->route('id')]);
        $request->validate([
            'tuto_id' =>'required|integer|exists:tutorials,id',
        ]);

        $tutoToDelete = $this->tutorialRepository->findOne($tuto_id);
        return $this->tutorialService->deleteAndReorder($tutoToDelete);
    }

    public function copyVideoStream(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'video' => 'required|file|max:200000',
        ]);

        $videoFile = $request->file('video');  
        $videoMeta = $request->except('video');

         return $this->cloudflareStreamService->copyVideoStream($videoFile, $videoMeta);
    }




}
