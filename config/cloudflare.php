<?php

return [

    'api_token' => env("CLOUDFLARE_API_TOKEN"),
    'account_id' => env("CLOUDFLARE_ACCOUNT_ID"),
    'allowed_orign_cloudFlare' => env("CLOUDFLARE_ALLOWED_ORIGIN_DOMAIN_".strtoupper(config("app.env"))),

    'endpoints' => [
        "watermarks" =>env("CLOUDFLARE_BASE_URL").'/stream/watermarks/',
        "upload_video_file" => env('CLOUDFLARE_BASE_URL').'/stream',
        "generate_secure_stream_key" => env('CLOUDFLARE_BASE_URL').'/stream/keys',
    ]
];
