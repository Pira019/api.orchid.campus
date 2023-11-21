<?php
namespace App\Service\ManagerService;

use App\Models\DetailProgram;
use App\Service\ServiceRessource;

class UniversityProgramService extends ServiceRessource
{

    public function __construct(DetailProgram $model)
    {
        $this->model = $model;
    }

}
