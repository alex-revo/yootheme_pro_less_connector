<?php
/* Herzog Dupont Copyright (C) 2021 Thomas Weidlich GNU GPL v3 */

// No direct access to this file
defined('_JEXEC') or die();

use YOOtheme\Builder;
use YOOtheme\Path;
use function YOOtheme\app;
use YOOtheme\Config;

include_once __DIR__ . '/src/SettingsListener.php';
//echo "boot";
$config = app(Config::class);
$theme = $config->get('~theme');
//print_r($theme);
if (isset($theme['child_theme'])) {

    $folder = JPATH_SITE . '/templates/yootheme_' . $theme['child_theme'] . '/less/';

    if (is_dir($folder)) {
        // Load all modules
        echo "yes";
    }
}

return [
    'theme' => [
        'styles' => [
            'components' => [
                'my-component' => (JPATH_SITE . '/templates/yootheme_child/less/custom.less'),
            ],
        ],
    ],
    'events' => [

        // Add settings Panels
        'customizer.init' => [
            SettingsListener::class => 'initCustomizer',
        ]

    ],


];
