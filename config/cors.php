<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   'supportsCredentials' => false,
   'allowedOrigins' => [env('CLIENT_URL')],
   'allowedHeaders' => ['Content-Type', 'X-Requested-With'],
   'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
   'exposedHeaders' => [],
   'maxAge' => 0,
];