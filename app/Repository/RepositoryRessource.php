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
    public function getFirst($column,$value,$columns=['*'])
    {
        return $this->model::where($column,$value)->first($columns);
    }

    public function find($column,$value,$columns=[""]){
        return $this->model::where($column,$value)->get($columns);
    }

}
