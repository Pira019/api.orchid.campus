<?php
namespace App\Models\Traits;

trait TUploadMetadata
{
   public static function uploadMetaEncodeBase64($videoName,$requiresignedurls='true'){

        $encodedVideoName = base64_encode($videoName);
        $allowedoriginDomains = base64_encode('orchid-campus.com');
        $watermakerID = base64_encode('0edddba2645e16f4f4d77725fe48cbf5');

        return "requireSignedURLS $requiresignedurls, name $encodedVideoName, allowedorigins $allowedoriginDomains,watermark $watermakerID";
    }
}
