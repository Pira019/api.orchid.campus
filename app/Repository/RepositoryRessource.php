<?php
namespace App\Repository;
class RepositoryRessource {
    protected $model;

    protected function getAll($collumns = ['*']){
        return $this->model::get($collumns);
    }

}
