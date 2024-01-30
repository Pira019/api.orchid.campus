<?php
namespace App\Service\ManagerService;

use App\Models\UserVideoKey;
use App\Service\ServiceRessource;


class UserVideoKeyService extends ServiceRessource
{
    public function __construct(UserVideoKey $model)
    {
        $this->model = $model;
    }

    //only for those who can manage tuto
    public function saveUserToken($userName,$tokenId,$tokenValue)
    {
        $data = [
            "user_name" => $userName,
            "id" => $tokenId,
            "key" => $tokenValue,
        ];
        return $this->create($data) ;
    }
}
