<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\Manager\SettingRepository;
use App\Service\ManagerService\SettingService;
use App\Service\ManagerService\TutoVideos\CloudflareStreamService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(public CloudflareStreamService $cloudflareStreamService, public SettingService $settingService,public SettingRepository $settingRepository)
    {}

    public function createWaterMark(Request $request)
    {

        $request->validate([
            'name' =>'required|string|max:55',
            'file' =>'required|file|mimes:png|max:2048',
        ]);

         $isExist = $this->settingRepository->isWatermarksExixts();

        if($isExist){

            $errorMessage = [
                "error" => "watermark existe",
            ];
            return response($errorMessage, 500);
        }


        return $this->settingService->saveWatermark($request->file('file'),$request->name);
    }

    public function getWatermark()
    {
        return $this->settingRepository->findWatermark();
    }

    public function signVideo(Request $request)
    {

        $request->validate([
            'jwkKey' =>'required|string',
            'keyID' =>'required|string',
            'videoUID' =>'required|string',
        ]);
        return $this->cloudflareStreamService->generateSignedToken($request->jwkKey,$request->keyID,$request->videoUID);

    }






}
