<?php
namespace App\Repository;
class RepositoryRessource
{
    protected $model;

    protected function getAll($columns = ['*'])
    {
        return $this->model::get($columns);
    }
    /*
    retrieve the first result of the query
    @columns columns return
    */
    protected function getFirst($column,$value,$columns=['*'])
    {
        return $this->model::get($columns)->where($column,$value)->firstOrFail();
    }

}
