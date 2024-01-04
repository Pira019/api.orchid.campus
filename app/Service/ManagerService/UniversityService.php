<?php
namespace App\Service\ManagerService;

use App\Models\DetailProgram;
use App\Models\University;
use App\Service\ServiceRessource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class UniversityService extends ServiceRessource
{

    public function __construct(University $model)
    {
        $this->model = $model;
    }

    public function save($city, $data)
    {
        if (!$city) {
            return null;
        }
        return $city->universties()->create($data)->makeHidden(['updated_at', 'created_at', 'webSite']);
    }

    public function edit($cityId, array $data)
    {
        if (!$cityId) {
            return null;
        }
        $data['city_id'] = $cityId;
        $id = $data['id'];

        // Remove 'id' from $data
        unset($data['id']);

        return $this->updateOne($data, $id);
    }

    public function addAddress($university, array $adress)
    {
        if (!$university) {
            return null;
        }
        return $university->address()->create($adress);
    }

    public function addOrUpdateProgram($university, $program, array $detailProgram, $isUpdate = false)
    {

        try {

            // Check if the program is already attached to the university
            $existingProgram = $university->programs();

            if($isUpdate && $existingProgram->find($program->id)){
                $university->programs()->updateExistingPivot($program->id, $detailProgram);
            }else{
                $university->programs()->attach($program,$detailProgram);
                return $existingProgram->find($program->id)->id;
            }

        } catch (QueryException $e) {

            if ($e->getCode() == '23505') {
                return response()->json(['error' => trans('http-statuses.HTTP_CONFLICT_PROPGRAM')], Response::HTTP_CONFLICT);
            }

            throw $e;
        }
    }
}
