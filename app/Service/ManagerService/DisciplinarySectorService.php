<?php
namespace App\Service\ManagerService;

use App\Core\ServiceUtils;
use App\Models\DisciplinarySector;
use App\Service\ServiceRessource;

class DisciplinarySectorService extends ServiceRessource
{

    public function __construct(DisciplinarySector $model)
    {
        $this->model = $model;

    }

    public function save($data)
    {
           return $this->model->firstOrCreate(
                    ['label' => ServiceUtils::ucfirst_lower($data['discipline_name'])],
                    ['description' => $data['discipline_description']]);
    }


}
