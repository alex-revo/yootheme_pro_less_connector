<?php
/* Herzog Dupont Copyright (C) 2021 Thomas Weidlich GNU GPL v3 */

// No direct access to this file
defined('_JEXEC') or die();

use YOOtheme\Builder;
use YOOtheme\Path;

return [
    'theme' => [
        'styles' => [
            'components' => [
                'my-component' => (JPATH_SITE . '/templates/yootheme_child/less/custom.less'),
            ],
        ],
    ],
];
