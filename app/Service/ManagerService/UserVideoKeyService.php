<?php
namespace App\Service\ManagerService;

use App\Models\UserVideoKey;
use App\Service\ManagerService\TutoVideos\CloudflareStreamService;
use App\Service\ManagerService\VideoAccessService;
use App\Service\ServiceRessource;


class UserVideoKeyService extends ServiceRessource
{
    public function __construct(UserVideoKey $model, public CloudflareStreamService $cloudflareStreamService,public VideoAccessService $videoAccessService)
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

    public function generateToken($videoId,$idExtra)
    {
     $managers = $this->model->select("key","id","user_name")->get();

     $userData = [];

     foreach($managers as $item){
        $videoToken = $this->cloudflareStreamService->generateVideoSignedToken($item->key,$item->id,$videoId);
        $userData[] = [
            "user_name" => $item->user_name,
            "signature" =>  $videoToken,
            "extra_tutorial_id" => $idExtra,
        ];
     }
     //save 
     $this->videoAccessService->insertOrIgnore($userData);
     //return $userData;

    }
}
