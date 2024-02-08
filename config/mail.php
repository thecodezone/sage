<?php

return [
    'smtp' => [
        'host' => env('MAIL_HOST', 'sandbox.smtp.mailtrap.io'),
        'port' => env('MAIL_PORT', 2525),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
    ],
];
