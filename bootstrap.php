<?php
// No direct access to this file
defined('_JEXEC') or die();

use YOOtheme\Builder;
use YOOtheme\Path;

$prefix = PlgSystemRevo_Less_Connector::$config->get('childthemename');
$folder = JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/';

if (is_dir($folder)) {
    $files = scandir($folder);
    //check the file extension
    foreach ($files as $key => $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) != 'less') {
            unset($files[$key]);
        }
    }

    $count = count($files);
    if ($count) {
        $components = "";
        foreach ($files as $file) {
            $name = basename($file, '.less');
            --$count;
            $components .= '"' . $name . '":"' . JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/' . $file . '"';
            if ($count) {
                $components .= ',';
            }
        }
        //echo $components;
        $json = '{"theme":{"styles":{"components":{' . $components . '}}}}';
        //echo $json;
        return json_decode($json, true);
    } else {
        return [];
    }
} else {
    return [];
}


//test connect custom.less and revo.less
//$json = '{"theme":{"styles":{"components":{"custom":"' . JPATH_SITE . '/templates/yootheme_child/less/custom.less","revo":"' . JPATH_SITE . '/templates/yootheme_child/less/revo.less"}}}}';
//echo json_decode($json, true);
/* if ($prefix && is_dir($folder)) {
    return [
        'theme' => [
            'styles' => [
                'components' => [
                    'my-component' => (JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/custom.less'),
                    'my-component2' => (JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/revo.less'),
                    //  $name => (JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/revo.less'),
                    //  $components,
                ],
            ],
        ],
    ];
    //    return json_decode($json, true);
} else {
    return [];
} */
