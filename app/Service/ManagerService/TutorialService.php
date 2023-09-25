<?php
namespace App\Service\ManagerService;

use App\Models\CountryStep;
use App\Models\Tutorial;
use App\Service\ServiceRessource;
use Illuminate\Http\Response;

class TutorialService extends ServiceRessource
{

    public function __construct(Tutorial $model)
    {
        $this->model = $model;
    }

    public function save($data)
    {
        $findStepId = CountryStep::find($data['step_id']);
        try {
            return $findStepId->tutorials()->create($data)->makeHidden(['tutorialable_id', 'tutorialable_type']);
        } catch (\Exception $e) {
            return response()->json(['data' => "Donné dupliquée"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function deleteAndReorder($tutoToDelete)
    {
        $tutoToDelete->delete(); // delete tuto

        //reOrder
        return $this->model->where("tutorialable_id", $tutoToDelete->tutorialable_id)->where("tutorialable_type", $tutoToDelete->tutorialable_type)->where("order", ">", $tutoToDelete->order)->decrement("order");
    }

}
