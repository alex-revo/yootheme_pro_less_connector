<?php
/*
 * @package    Revo Debugger System Plugin
 * @version    0.0.1
 * @author     Alex Revo - alexrevo.pw
 * @copyright  Copyright (c) 2021 Alex Revo. All rights reserved.
 * @license    MIT
 * @link       https://alexrevo.pw/
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\Registry\Registry;
use YOOtheme\Application;
use function YOOtheme\app;
use YOOtheme\Config;

class PlgSystemRevo_Debugger extends JPlugin
{
	protected function getConfig()
	{
		if (!class_exists('JConfig')) {
			include_once JPATH_CONFIGURATION . '/configuration.php';
		}
		$registry = new Registry;
		$config = new JConfig;
		$registry->loadObject($config);
		return $registry;
	}
	public function onBeforeCompileHead()
	{

		if (class_exists('YOOtheme\Event')) {

			$yconfig = app(Config::class);
			$app = JFactory::getApplication();
			$doc = JFactory::getDocument();
			$jconfig = $this->getConfig();

			$enabled = JPluginHelper::isEnabled('system', 'cache');

			if ($app->isClient('administrator') && $yconfig('app.isCustomizer')) {
				HTMLHelper::_('script', 'plg_system_revo_debugger/debug.js', ['relative' => true, 'version' => '0.0.1']);
				HTMLHelper::_('stylesheet', 'plg_system_pagebuilder_toolkit/revodebugger.css', ['relative' => true, 'version' => '0.0.1']);
				$script = "var PBT = {urlFull: '" . Uri::root(false) . "', urlBase: '" . Uri::root(true) . "', MIV: '" . ini_get('max_input_vars') . "', MEM: '" . ini_get('memory_limit') . "', SCH: '" . $jconfig->get('caching', 0) . "', SES: '" . $jconfig->get('shared_session') . "', PCP: '" . $enabled . "',  PMS: '" . ini_get('post_max_size') . "'};";
				$doc->addScriptDeclaration($script);
				HTMLHelper::_('jquery.framework');
			}
		}

		return true;
	}
	public function onAfterInitialise()
	{
		// Check if YOOtheme Pro is loaded
		if (!class_exists(Application::class, false)) {
			echo 'no';
			return;
		}
		$app = Application::getInstance();
		$app->load(__DIR__ . '/bootstrap.php');
	}
}
