<?php

return [

    'api_token' => env("CLOUDFLARE_API_TOKEN"),
    'account_id' => env("CLOUDFLARE_ACCOUNT_ID"), 

    'endpoints' => [
        "watermarks" => config('cloudflare.base_url').'/stream/watermarks',
        "upload_video_file" => env ('CLOUDFLARE_BASE_URL').'/stream',
    ]
];
