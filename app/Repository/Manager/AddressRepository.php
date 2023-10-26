<?php
namespace App\Repository\Manager;

use App\Models\Address;
use App\Repository\RepositoryRessource;

class AddressRepository extends RepositoryRessource
{

    public function __construct(Address $model)
    {
        $this->model = $model;
    } 
}
