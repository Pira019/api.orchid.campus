<?php
namespace App\Service\ManagerService;

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

    public function addOrUpdateProgram($universityId, $program, array $detailProgram, $isUpdate = false,$idProgramToUpdate=null)
    {

        try {
            $prapareQuery = $this->model->find($universityId)->programs();

            if ($isUpdate && $idProgramToUpdate) {
                return $prapareQuery->wherePivot('id', $idProgramToUpdate)->first()->pivot->update([...$detailProgram, "program_id" => $program->id]);

            } else {

                $prapareQuery->attach($program, $detailProgram);
                return $prapareQuery->find($program->id)->id;
            }

        } catch (QueryException $e) {

            if ($e->getCode() == '23505') {
                return response()->json(['error' => trans('http-statuses.HTTP_CONFLICT_PROPGRAM')], Response::HTTP_CONFLICT);
            }

            throw $e;
        }
    }
}
