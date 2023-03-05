<?php

namespace App\Service;

use App\Models\User;
use App\Service\ServiceRessource;

class UserService extends ServiceRessource{
    public function __contruct(){

    }

    public function save($data){
       $this->model=new User();
       $this->create($data);
    }

    public function userName($name,$idCustomer){
        return substr(strtoupper($name),0,2) . date('Hi') . $idCustomer;
    }
}

