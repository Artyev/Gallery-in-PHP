<?php

namespace Gallery;

use Gallery\Model\GalleryTableFactory;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\GalleryController::class => InvokableFactory::class,
        ],
    ],

    'router' => [
        'routes' => [
            'gallery' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/gallery[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\GalleryController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],


    'view_manager' => [
        'template_path_stack' => [
            'gallery' => __DIR__ . '/../view',
        ],
    ],
];
