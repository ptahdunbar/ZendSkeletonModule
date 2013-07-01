<?php
/**
 * ZF2 Views Configuration.
 *
 * See the link below for more info:
 * @link http://zf2.readthedocs.org/en/latest/modules/zend.view.quick-start.html
 */
return [
    'view_manager' =>
    [
        'template_map' =>
        [
            'zend-skeleton-module/index/index' => __DIR__ . '/../../view/zend-skeleton-module/index/index.phtml',
        ],
    ]
];