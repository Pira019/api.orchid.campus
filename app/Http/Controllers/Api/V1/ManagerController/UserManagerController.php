<?php

namespace App\Http\Controllers\Api\V1\ManagerController;


use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\AddUserVideoKeyRequest;
use App\Service\ManagerService\TutoVideos\CloudflareStreamService;
use App\Service\ManagerService\UserVideoKeyService;

class UserManagerController extends Controller
{
    public function __construct(public CloudflareStreamService $cloudflareStreamService)
    {

    }

    public function saveUserToken(AddUserVideoKeyRequest $request,UserVideoKeyService $userVideoKeyService)
    {
      $userVideoKey = $this->cloudflareStreamService->generateUserSignedToken();

      if(!$userVideoKey["success"]){
        return false;
      }

      $keyId = $userVideoKey["result"]["id"];
      $key = $userVideoKey["result"]["pem"];

      return $userVideoKeyService->saveUserToken($request->user_name,$keyId,$key);
    }
}
