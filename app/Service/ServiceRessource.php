<?php
namespace App\Service;
class ServiceRessource {

    protected $model;
    protected function create($data){
      return $this->model::create($data);
    }

}
