<?php
namespace App\Service\ManagerService\TutoVideos;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Config;
use App\Models\Traits\TUploadMetadata;
use Firebase\JWT\JWT;

class CloudflareStreamService
{
    use TUploadMetadata;
    protected $apiToken;

    public function __construct(public Client $clientHttp)
    {
        $this->apiToken = Config::get('cloudflare.api_token');
    }

    public function copyVideoStream($videoFile,$videoTutoName,$watermakerID,$isPrivate,$creatorUserName=null)
    {

        try{

         $url = Config::get('cloudflare.endpoints.upload_video_file');


         $request = $this->clientHttp->post($url,
         [
            'headers' => $this->getCommonHeaders($this->uploadMetaEncodeBase64($videoTutoName,$watermakerID,$isPrivate),filesize($videoFile->path()),$creatorUserName),

         ]);

        // Traitez la réponse, si nécessaire
        $locationUrl = $request->getHeaderLine('Location');
        $this->completeUpload($locationUrl,$videoFile);

        return $request->getHeaderLine('stream-media-id');

        } catch(ClientException  $e)
        {
            return ['error' => $e->getResponse()->getBody()->getContents()];
        }
    }

    private function getCommonHeaders($uploadMetaData=false,$fileSize=null,$creatorUserName=null)
    {
        return [
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Upload-Creator' => "orchid-campus_$creatorUserName",
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

    public function createWatermark($image,$name)
    {
        try
        {
           $url = Config::get('cloudflare.endpoints.watermarks');
           $response = $this->clientHttp->post($url,
           [
           'headers' =>  [
           'Authorization' => "Bearer $this->apiToken", ],

           'multipart' => [
            [
                'name' => 'file',
                'contents' =>fopen($image->path(), 'r'),
            ],
            [
                'name' => 'name',
                'contents' => $name,
            ],

        ],
        ]);

       return json_decode($response->getBody()->getContents(), true);

        } catch(ClientException  $e){
            return ['error' => $e->getResponse()->getBody()->getContents()];
        }
    }

    function generateVideoSignedToken($pemKey, $keyID, $videoUID)
    {
        $expiresTimeInS = 24 * 60 * 60;

        // Main function
        $expiresIn = time() + $expiresTimeInS;
        $headers = [
            'alg' => 'RS256',
            'kid' => $keyID,
        ];

        $data = [
            'sub' => $videoUID,
            'kid' => $keyID,
            'exp' => $expiresIn,
            "downloadable"  => false,
        ];

        $token = JWT::encode($data, base64_decode($pemKey), 'RS256' , null, $headers);

        return $token;
    }

    public function generateUserSignedToken()
    {
        try
        {
           $url = Config::get('cloudflare.endpoints.generate_secure_stream_key');
           $response = $this->clientHttp->post($url,
           [
           'headers' =>  [
           'Authorization' => "Bearer $this->apiToken", ]
        ]);

       return json_decode($response->getBody()->getContents(), true);

        } catch(ClientException  $e){
            return ['error' => $e->getResponse()->getBody()->getContents()];
        }
    }



}

