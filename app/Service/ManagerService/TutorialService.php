<?php
namespace App\Service\ManagerService;

use App\Models\CountryStep;
use App\Models\Tutorial;
use App\Service\ServiceRessource;
use Illuminate\Http\Response;

class TutorialService extends ServiceRessource{

    public function __construct(Tutorial $model){
        $this->model = $model;
    }

   public function save($data){
    $findStepId = CountryStep::find($data['step_id']);
    try{
        return $findStepId->tutorials()->create($data);
    }catch(\Exception $e){
        return response()->json(['data' => "Donné dupliquée"], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

   }
}
