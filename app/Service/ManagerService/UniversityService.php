<?php
namespace App\Service\ManagerService;

use App\Models\University;
use App\Service\ServiceRessource;

class UniversityService extends ServiceRessource
{

    public function __construct(University $model)
    {
        $this->model = $model;
    }


}
