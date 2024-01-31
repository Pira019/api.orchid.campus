<?php
namespace App\Models\Traits; 

trait TUploadMetadata
{
    public static function uploadMetaEncodeBase64($videoName, $watermakerID, $requiresignedurls) { 

        $orgins = Config('cloudflare.allowed_orign_cloudFlare');

        $result = [
            "name " . base64_encode($videoName),
            "watermark " . base64_encode($watermakerID),
            "requiresignedurls " . ($requiresignedurls ? "true" : "false"),
        ];

       if ($orgins){      
        $orginsBase64 = base64_encode($orgins); 
        $result[] = "allowedorigins $orginsBase64";
        }

        return implode(', ', $result);
    }
    
}
