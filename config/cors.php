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
    'supportsCredentials' => true,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['GET','POST','PUT','DELETE','OPTIONS'],
    'exposedHeaders' => ['DAV', 'content-length', 'Allow'],
    'maxAge' => 86400,
    'hosts' => [],
];

