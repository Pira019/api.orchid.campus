<?php
namespace App\Service\ManagerService;

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
                    ['label' => $data['discipline_name']],
                    ['description' => $data['discpline_description']]);
    }


}
