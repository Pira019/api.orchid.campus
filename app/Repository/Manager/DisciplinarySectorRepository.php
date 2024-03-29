<?php
namespace App\Repository\Manager;

use App\Models\DisciplinarySector;
use App\Repository\RepositoryRessource;

class DisciplinarySectorRepository extends RepositoryRessource
{

    public function __construct(DisciplinarySector $model)
    {
        $this->model = $model;
    }

    static function getDisciplinaryIds(array $ids){
        return DisciplinarySector::whereIn('id',$ids)->pluck('id');
    }

    public function getDisciplinaryWithProgram(){
        return $this->model->whereHas('programs.universities')->orderBy('name')->select('id','label as name')->get();

    }
}
