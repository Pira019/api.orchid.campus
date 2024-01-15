<?php
namespace App\Models\Traits;
use Illuminate\Support\Facades\Config;

trait TUploadMetadata
{
   public static function uploadMetaEncodeBase64($videoName,$requiresignedurls='true'){

        $encodedVideoName = base64_encode($videoName);
        $allowedoriginDomains = base64_encode('orchid-campus.com');
        $watermakerID = base64_encode(Config::get('cloudflare.watermarks_id'));

        return "requireSignedURLS $requiresignedurls, name $encodedVideoName, allowedorigins $allowedoriginDomains,watermark $watermakerID";
    }
}
