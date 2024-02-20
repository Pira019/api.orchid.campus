<?php
namespace App\Service\ManagerService;

use App\Exceptions\CloudFlareException;
use App\Models\ExtraTutorial;
use App\Service\ManagerService\TutoVideos\CloudflareStreamService;
use App\Service\ServiceRessource;

class ExtraTutorialService extends ServiceRessource
{

    public function __construct(ExtraTutorial $model,public CloudflareStreamService $cloudflareStreamService)
    {
        $this->model = $model;
    }

    public function saveVideo($data, $videoId, $creator)
    {
        $data = [...$data, "link_video" => $videoId, "creator" => $creator];
        return $this->create($data);
    }

    public function deleteVideo($idExtraVideo,$videoIdentifier)
    {
        $isDelete =  $this->cloudflareStreamService->deleteVideo($videoIdentifier);
        if(!$isDelete)
        {
          throw new CloudFlareException("Erreur video id introuvable CLOUD-STREAM", 404);
        }

        return $this->destroy($idExtraVideo);
    }
}
