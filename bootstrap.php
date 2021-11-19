<?php
// No direct access to this file
defined('_JEXEC') or die();

use YOOtheme\Builder;
use YOOtheme\Path;

$themejsload = PlgSystemRevo_Less_Connector::getParams('childthemename');
echo $themejsload;
return [
    'theme' => [
        'styles' => [
            'components' => [
                'my-component' => (JPATH_SITE . '/templates/yootheme_child/less/custom.less'),
            ],
        ],
    ],
];
