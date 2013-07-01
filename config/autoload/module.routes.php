<?php
/**
 * ZF2 MVC Routing & Controller Configuration.
 *
 * Also defines the controllers to easily reference
 * them when defining new routes.
 *
 * See the link below for more info:
 * @link http://zf2.readthedocs.org/en/latest/modules/zend.mvc.routing.html
 */
return [
    'controllers' =>
    [
        'invokables' =>
        [
            'ZendSkeletonModule\Controller\Index' => 'ZendSkeletonModule\Controller\IndexController'
        ],
    ],
    'router' =>
    [
        'routes' =>
        [
            'ZendSkeletonModule' =>
            [
                'type'    => 'literal',
                'options' =>
                [
                    'route'    => '/zend-skeleton-module',
                    'defaults' =>
                    [
                        '__NAMESPACE__' => 'ZendSkeletonModule\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' =>
                [
                    'default' =>
                    [
                        'type'    => 'segment',
                        'options' =>
                        [
                            'route'    => '/[:controller[/:action]]',
                            'constraints' =>
                            [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' =>
                            [
                                //
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];