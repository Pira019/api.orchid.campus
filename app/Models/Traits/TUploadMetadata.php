<?php
namespace App\Models\Traits;
use Illuminate\Support\Facades\Config;

trait TUploadMetadata
{
   public static function uploadMetaEncodeBase64($videoName,$watermakerID_,$requiresignedurls_){

        $encodedVideoName = base64_encode($videoName);
        $allowedoriginDomains = base64_encode('orchid-campus.com');
        $watermakerID = base64_encode($watermakerID_);
        $requiresignedurls = $requiresignedurls_ ? "true" : "false" ;

        return "requireSignedURLS $requiresignedurls, name $encodedVideoName, allowedorigins $allowedoriginDomains,watermark $watermakerID";
    }
}
