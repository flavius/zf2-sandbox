<?php
return [
    'router' => [
        'routes' => [
            'albumindex' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/albums',
                    'defaults' => [
                        'controller' => 'Album\Controller\Index',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Album\Controller\Index' => 'Album\Controller\IndexController',
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'album/index/index' => __DIR__ . '/../view/album/index/index.phtml',
        ],
    ],
];
