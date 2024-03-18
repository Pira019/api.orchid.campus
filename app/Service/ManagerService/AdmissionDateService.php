<?php
namespace App\Service\ManagerService;

use App\Models\AdmissionDate;
use App\Service\ServiceRessource;

class AdmissionDateService extends ServiceRessource
{

    public function __construct(AdmissionDate $model)
    {
        $this->model = $model;
    }

    public function saveDate($dateAdmission){

        $conditions = [
                       ['detail_program_id', '=', $dateAdmission['detail_program_id']],
                       ["iscurrent_admission", '=', true ]
                    ];

        $this->model->where($conditions)->update( ["iscurrent_admission"=> false]); // set iscurrent_admission to false

        $data= [...$dateAdmission, "iscurrent_admission"=> true];

        return $this->create($data);
    }






}
