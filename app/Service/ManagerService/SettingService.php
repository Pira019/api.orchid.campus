<?php
namespace App\Service\ManagerService;

use App\Core\ServiceUtils;
use App\Models\Setting;
use App\Service\ManagerService\TutoVideos\CloudflareStreamService;
use App\Service\ServiceRessource;
use App\Enums\SettingTypeEnum;

class SettingService extends ServiceRessource
{

    public function __construct(Setting $model, public CloudflareStreamService $cloudflareStreamService,public ServiceUtils $serviceUtils)
    {
        $this->model = $model;
    }

    public function saveWatermark($file,$nameFile_)
    {
        $nameFile = $this->serviceUtils->replaceSpaceToHyphen($nameFile_);

        $cloudflareResponse = $this->cloudflareStreamService->createWatermark($file,$nameFile);

       if (!$cloudflareResponse['success']) {

            $errorMessage = [
                "error" => "Cloudfare error",
            ];
            return response($errorMessage, 500);
        }



       $saveSettingDate = $this->prepareSettingData($cloudflareResponse['result']['uid']);

       $saveImage = [
            "name" => $nameFile,
            "url" => $this->serviceUtils->storeImage($file,$nameFile)
       ];

      return  $this->create($saveSettingDate)->image()->create($saveImage)->url;
    }

    function prepareSettingData($refType)
    {
        return [
            'type' => SettingTypeEnum::WATERMARK->value,
            'refType' => $refType,
        ];
    }
}
