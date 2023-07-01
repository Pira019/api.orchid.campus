<?php
namespace App\Service;
class ServiceRessource {

    protected $model;
    protected function create($data){
      return $this->model::create($data);
    }
    //save and arrays of column names and values
    protected function insert(array $data){
      return $this->model::insert($data);
    }

}
