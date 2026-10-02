<?php

return [
    'asset_delivery' => [
        'bucket' => env('ASSET_DELIVERY_BUCKET', 'lunarix-ad1'),
        'key_id' => env('BUCKET_KEY_ID', ''),
        'secret_key' => env('BUCKET_SECRET_KEY', ''),
        'endpoint' => env('ASSET_DELIVERY_BUCKET_ENDPOINT', 'https://ad1.lunarix.my'),
        'use_path_style' => env('ASSET_DELIVERY_USE_PATH_STYLE', true),
    ],
];