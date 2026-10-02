<?php
return [
    'paths' => ['api/*', '*'],
    'allowed_origins' => ['https://synvo.live', 'https://*.synvo.live'],
    'allowed_origins_patterns' => ['#^https://([a-z0-9-]+\.)?synvo\.live$#',],
    'allowed_methods' => ['*'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true
];