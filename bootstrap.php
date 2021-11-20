<?php
// No direct access to this file
defined('_JEXEC') or die();

use YOOtheme\Builder;
use YOOtheme\Path;

$prefix = PlgSystemRevo_Less_Connector::$config->get('childthemename');
$folder = JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/';

if (is_dir($folder)) {
    $files = scandir($folder);
    $components = "";
    foreach ($files as $file) {
        if (strrpos($file, '.less', -1)) {
            $info['filename'] = basename($file, '.less');
            $components .= "'" . $info['filename'] . "'=>'" . JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/' . $file . "',";
        }
    }
}

//echo $components;
$json = '{"theme":{"styles":{"components":{"custom":"' . JPATH_SITE . '/templates/yootheme_child/less/custom.less","revo":"' . JPATH_SITE . '/templates/yootheme_child/less/revo.less"}}}}';
//echo json_decode($json, true);
if ($prefix && is_dir($folder)) {
    // return [
    //     'theme' => [
    //         'styles' => [
    //             'components' => [
    //                 'my-component' => (JPATH_SITE . '/templates/yootheme_' . $prefix . '/less/custom.less'),
    //             ],
    //         ],
    //     ],
    // ];
    return json_decode($json, true);
} else {
    return [];
}
