<?php

/**
 * @package   Revo LESS connector for YOOtheme Pro
 * @author    Alex Revo https://alexrevo.pw
 * @copyright Copyright (C) Aleksandr Sudbinov
 * @license   GPL v.3
 */

defined('_JEXEC') or die;

class PlgSystemRevo_Less_ConnectorInstallerScript
{
    public function install($parent)
    {
        // Enable the extension
        $this->enablePlugin();
        return true;
    }

    private function enablePlugin()
    {
        try {
            $db    = JFactory::getDbo();
            $query = $db->getQuery(true)
                ->update($db->qn('#__extensions'))
                ->set($db->qn('enabled') . ' = ' . $db->q(1))
                ->where('type = ' . $db->q('plugin'))
                ->where('element = ' . $db->q('revo_less_connector'));
            $db->setQuery($query);
            $db->execute();
        } catch (\Exception $e) {
            return;
        }
    }
}
