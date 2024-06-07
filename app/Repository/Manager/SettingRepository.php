<?php
namespace App\Repository\Manager;

use App\Enums\SettingTypeEnum;
use App\Models\Setting;
use App\Repository\RepositoryRessource;

class SettingRepository extends RepositoryRessource
{

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }


    public function isWatermarksExixts()
    {
        return $this->isExists("type",SettingTypeEnum::WATERMARK->value);
    }

    public function findWatermark()
    {
        
     return $this->getFirst("type", SettingTypeEnum::WATERMARK->value)?->with(['image:imageable_id,url'])
     ->select('refType','updated_at','id')->first();
    }

}
