<?php
namespace App\Repository;
class RepositoryRessource
{
    public $model;

    public function getAll(array $columns = ['*'])
    {
        return $this->model::get($columns);
    }

    public function getPaginating($nbrPerPage=2,$columns="*")
    {
        return $this->model::select($columns)->paginate($nbrPerPage);
    }
    /*
    retrieve the first result of the query
    @columns columns return
    */
    /**
     * Summary of getFirst
     * @param mixed $column
     * @param mixed $value
     * @param mixed $columns
     * @return mixed
     */
    public function getFirst($column,$value,$columns=['*'])
    {
        return $this->model::where($column,$value)->first($columns);
    }

    /**
     * Summary of find
     * @param mixed $column
     * @param mixed $value
     * @param mixed $columns
     * @return mixed
     */
    public function find($column,$value,$columns=[""]){
        return $this->model::where($column,$value)->get($columns);
    }

    public function findOne($value){
        return $this->model::find($value);
    }

   /*
    retrieve the first result of the query
    @columns columns return
    */
    /**
     * Summary of getWhere
     * @param mixed $value
     * @param mixed $signe
     * @param mixed $column
     * @param mixed $columns
     * @return mixed
     */
    public function getWhere($value,$signe="=",$column="id",$columns=['*'])
    {
        return $this->model::where($column,$signe,$value)->get($columns);
    }

    public function firstOrCreate($data){
        return $this->model ::firstOrCreate($data);
    }

    /*
    returns a boolean indicating whether any records match
    */
    /**
     * @param mixed $columsData ex:  ["name" => "luf"]
     * @return boolean
     */
    public function isExists($column,$value)
    {
        return $this->model::where($column,$value)->exists();
    }

    public function findOrFail($id){
        return $this->model::findOrFail($id);
    }

    public function getWhereIn(array $value,$column ="id"){
        return $this->model::whereIn($column,$value);
    }

}
