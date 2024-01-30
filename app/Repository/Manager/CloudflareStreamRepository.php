<?php
namespace App\Repository\Manager;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Config;

class CloudflareStreamRepository
{

    protected $apiToken;

    public function __construct(public Client $clientHttp)
    {
        $this->apiToken = Config::get('cloudflare.api_token');
    }

    public function generateSecureStreamKey()
    {
        $url = Config::get('cloudflare.endpoints.generate_secure_stream_key'); 

        try{

            $request = $this->clientHttp->post($url,
            [
               'headers' =>  [ 'Authorization' => "Bearer $this->apiToken"],  
            ]);
    
            return json_decode($request->getBody(), true);

        }catch(ClientException $e){

            return ['error' => $e->getResponse()->getBody()->getContents()];

        } 

    }
}
