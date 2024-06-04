<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Core\ServiceUtils;
use App\Http\Controllers\Controller;
use App\Repository\Manager\TutorialRepository;
use App\Repository\Manager\SettingRepository;
use App\Service\ManagerService\TutorialService;
use App\Service\ManagerService\TutoVideos\CloudflareStreamService;
use App\Service\ManagerService\ExtraTutorialService;
use Illuminate\Http\Request;
use  App\Http\Requests\AddTutoVideoRequest;
use App\Http\Resources\ExtraTutorialResource;
use App\Repository\Manager\CountryRepository;
use App\Repository\Manager\CountryStepsRepository;
use App\Service\ManagerService\UserVideoKeyService;

class TutorialsController extends Controller
{
    public function __construct(public CountryRepository $countryRepository, public TutorialRepository $tutorialRepository, public TutorialService $tutorialService,public CloudflareStreamService $cloudflareStreamService)
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
        return $this->countryRepository->countrySteps();
    }

    public function getCountryStepsByCountryId($country_id,Request $request)
    {
        $request->merge(['country_id' => $request->route('id')]);
        $request->validate([
            'country_id' =>
                'required|integer|exists:countries,id',
        ]);
        return $this->countryRepository->getCountryStepsByCountryId($country_id);
    }

    public function save(Request $request)
    {
        $request->validate([
            'step_id' =>'required|integer|exists:country_steps,id',
            'title' =>'required|string|max:255',
            'order' =>'required|integer',
            'description' =>'nullable',
        ]);
      return $this->tutorialService->save($request->all());
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id' =>'required|integer|exists:tutorials,id',
            'title' =>'required|string|max:255',
            'description' =>'nullable',
        ]);
      $updated = $this->tutorialService->updateOne($request->only(['title','description']),$request['id']);

      if(!$updated){
        return $request->all();
      }
      return $this->tutorialRepository->findById($request['id']);
    }


    public function getTutosByStepCoutryId($stepCoutrty_id,Request $request, CountryStepsRepository $countryStepsRepository){
        $request->merge(['step_country_id' => $request->route('id')]);
        $request->validate([
            'step_country_id' =>
                'required|integer|exists:country_steps,id',
        ]); 
        return $countryStepsRepository->getTutosByStepCoutryId($stepCoutrty_id);
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

    public function addTutoVideo(AddTutoVideoRequest $request,UserVideoKeyService $userVideoKeyService,ExtraTutorialService $extraTutoVideoService,SettingRepository $settingRepository)
    {
        $request->validated();

        $videoFile = $request->file('video');
        $data = $request->except('video');

        $watermarkId = $settingRepository->findWatermark()?->refType;

        if(!$watermarkId){

            return response(['error' => 'Aucun filigrane trouvé. Veuillez ajouter un filigrane avant de continuer.'], 500);
        }

       $tutoriaInfo = $this->tutorialRepository->findById($request->tutorial_id);

       $videoName = ServiceUtils::concatenateAndMakeLowercase($tutoriaInfo->id,$tutoriaInfo->title);
       $creator = $request?->user()?->user_name;

       $videoId =  $this->cloudflareStreamService->copyVideoStream($videoFile,$videoName,$watermarkId,$request->isPrivate,$creator);
       $infoTuto = $extraTutoVideoService->saveVideo($data,$videoId,$creator);

        //give access to all manger or admin see ProfilNameEnum Enum
      if ($request->isPrivate) {
        $infoTuto->signature = $userVideoKeyService->generateToken($videoId, $infoTuto?->id, $creator);
        }

        return new ExtraTutorialResource($infoTuto);
    }




}
