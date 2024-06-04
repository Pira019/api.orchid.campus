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

}
