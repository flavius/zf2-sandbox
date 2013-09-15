<?php
return [
    'modules' => [
        'Application',
        'Album',
    ],
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{,*.}global.php',
            'config/autoload/{,*.}local.php',
        ],
    ],
];
