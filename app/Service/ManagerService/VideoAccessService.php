<?php
namespace App\Service\ManagerService;

use App\Models\VideoAccess;
use App\Service\ServiceRessource;

class VideoAccessService extends ServiceRessource
{

    public function __construct(VideoAccess $model)
    {
        $this->model = $model;

    }
  
}
