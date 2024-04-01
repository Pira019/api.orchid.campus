<?php
namespace App\Repository\Manager;

use App\Models\Service;
use App\Repository\RepositoryRessource;

class ServiceManagerRepository extends RepositoryRessource
{

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function getAllPaginate()
    {
        return $this->model::
            with(['country' => fn($query) => $query->select('id','name','flag_url')])
            ->paginate(5);
    }
}

