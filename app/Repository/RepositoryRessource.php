<?php
namespace App\Repository;
class RepositoryRessource
{
    protected $model;

    protected function getAll($columns = ['*'])
    {
        return $this->model::get($columns);
    }

}
