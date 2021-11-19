<?php

/* Herzog Dupont Copyright (C) 2021 Thomas Weidlich GNU GPL v3 */

// No direct access to this file
defined('_JEXEC') or die();

use YOOtheme\Config;
use function YOOtheme\app;

class SettingsListener
{

    public static function initCustomizer(Config $config)
    {
        function setItem($itemname, $label, $type, $desc, $hidden)
        {
            $config = app(Config::class);
            $config->set('customizer.sections.revodebug.fields.' . $itemname, [
                'label' => $label,
                'type' => $type,
                'description' => $desc,
                'attrs' => [
                    'hidden' => $hidden,
                ]
            ]);
        }

        $config->set('customizer.sections.revodebug', [
            'title'  => 'Debug Info',
            'width'  => 400,
            'fields' => [],
        ]);

        $miv = ini_get('max_input_vars');

        setItem(
            'miv',
            'Max input vars',
            '',
            '<span uk-icon="' . ($miv >= 10000 ? 'check' : 'close') . '" class="uk-icon-button uk-padding-small-left uk-text-' . ($miv >= 10000 ? 'success' : 'danger') . ' uk-icon"></span><span class="uk-h3 uk-padding-small">' . $miv . '</span><br/>Recomended 10 000.',
            true
        );

        $mem = (int)ini_get('memory_limit');

        setItem(
            'mem',
            'Memory limit',
            '',
            '<span uk-icon="' . ($mem >= 512 ? 'check' : 'close') . '" class="uk-icon-button uk-padding-small-left uk-text-' . ($mem >= 512 ? 'success' : 'danger') . ' uk-icon"></span><span class="uk-h3 uk-padding-small">' . $mem . 'M</span><br/>Recomended (minimum) 512M.',
            true
        );

        $config->set('customizer.sections.revodebug.fields.layout', [
            'label' => 'Current layout',
            'type' => 'textarea',
            'description' => 'Current JSON markup (read only).',
            'attrs' => [
                'class' => 'markup',
            ]
        ]);
        setItem('item3', '', '', '<button type="button" class="uk-button uk-button-default uk-width-1-1 uk-margin-small">theme support</button>', true);
        setItem('item2', '', '', '<button type="button" class="uk-button uk-button-muted uk-width-1-1">hire an expert</button>', true);
    }
}

// "', MEM: '" . ini_get('memory_limit') . "', SCH: '" . $jconfig->get('caching', 0) . "', SES: '" . $jconfig->get('shared_session') . "', PCP: '" . $enabled . "',  PMS: '" . ini_get('post_max_size') . "'};";