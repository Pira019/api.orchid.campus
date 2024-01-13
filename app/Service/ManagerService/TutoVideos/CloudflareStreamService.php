<?php
namespace App\Service\ManagerService\TutoVideos;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Config;
use App\Models\Traits\TUploadMetadata;

class CloudflareStreamService
{
    use TUploadMetadata;
    protected $apiToken;

    public function __construct(public Client $clientHttp)
    {
        $this->apiToken = Config::get('cloudflare.api_token');
    }

    public function copyVideoStream($videoFile,$videoMeta)
    {
        $videoMetaName = $videoMeta['name'];
        
        try{

         $url = Config::get('cloudflare.endpoints.upload_video_file');

         $request = $this->clientHttp->post($url,
         [
            'headers' => $this->getCommonHeaders($this->uploadMetaEncodeBase64($videoMetaName,'false'),filesize($videoFile->path())),

         ]);

        // Traitez la réponse, si nécessaire
        $locationUrl = $request->getHeaderLine('Location');
        $videoId = $request->getHeaderLine('stream-media-id');

        return $this->completeUpload($locationUrl,$videoFile);

        } catch(ClientException  $e)
        {
            return ['error' => $e->getResponse()->getBody()->getContents()];
        }
    }


    private function getCommonHeaders($uploadMetaData=false,$fileSize=null)
    {
        return [
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Upload-Creator' => 'orchid-campus_',
            'Tus-Resumable' => '1.0.0',
            'Upload-Length' => $fileSize,
            'Upload-Metadata' => $uploadMetaData,
        ];
    }

    public function completeUpload($locationUrl, $videoFile)
    {
        try {
            // Send a PATCH request to complete the upload
            $request = $this->clientHttp->request('PATCH', $locationUrl, [
                'headers'  => array_merge($this->getCommonHeaders(), [
                    'Upload-Offset' => 0,
                    'Content-Type'  => 'application/offset+octet-stream',
                ]),
              'body'  => fopen($videoFile->path(), 'r') 
            ]);

             return json_decode($request->getBody(), true);

        } catch (ClientException $e) {

            return ['error' => $e->getResponse()->getBody()->getContents()];
        }
    }

  
}

