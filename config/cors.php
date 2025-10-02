<?php

declare(strict_types=1);

return [
    'paths' => ['api/*', 'login', 'register'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
