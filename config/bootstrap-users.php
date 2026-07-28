<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Migration-created default user password
    |--------------------------------------------------------------------------
    |
    | Production deployments must provide this before running migrations when
    | one or more default accounts do not exist. Existing account passwords
    | are never overwritten by the data migration.
    |
    */
    'password' => env('BOOTSTRAP_DEFAULT_USER_PASSWORD'),
];
