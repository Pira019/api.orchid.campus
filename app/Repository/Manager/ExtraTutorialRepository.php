<?php
namespace App\Repository\Manager;

use App\Models\ExtraTutorial;
use App\Repository\RepositoryRessource;

class ExtraTutorialRepository extends RepositoryRessource
{

    public function __construct(ExtraTutorial $model)
    {
        $this->model = $model;
    }


    public function getVideoInfo($extraTuto){
      return  $extraTuto->load(['videoAccesses' => function($query) {
        $query->where('visibility', true)
        ->first();
    }])->videoAccesses;
    }

}
