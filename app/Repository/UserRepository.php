<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\RepositoryRessource;

class UserRepository extends RepositoryRessource {

    public function __construct(User $model){
        $this->model = $model;
    }

    public function getLoginToken(string $value,$column="email"){
       return $this->getFirst($column,$value);
    }

}

