<?php
namespace App\Service\ManagerService;

use App\Models\ExtraTutorial;
use App\Service\ServiceRessource; 

class ExtraTutorialService extends ServiceRessource
{

    public function __construct(ExtraTutorial $model)
    {
        $this->model = $model;
    }

    public function saveVideo($data,$videoId,$creator)
    {
        $data = [...$data , "link_video" => $videoId, "creator" => $creator];
        return $this->create($data);
    }
}
