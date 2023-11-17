<?php
namespace App\Service\ManagerService;

use App\Models\Program;
use App\Service\ServiceRessource;

class ProgramService extends ServiceRessource
{

    public function __construct(Program $model)
    {
        $this->model = $model;

    }

    public function save($data,$discplineSectoryId)
    {
        $program =  [
            'label' => $data['program_name'],
            'disciplinary_sector_id' =>$discplineSectoryId,
        ];

        return $this->firstOrCreate($program);
    }


}
