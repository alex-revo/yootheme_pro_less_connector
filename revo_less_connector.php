<?php
/*
 * @package    Revo LESS connector System Plugin
 * @version    0.0.1
 * @author     Alex Revo - alexrevo.pw
 * @copyright  Copyright (c) 2021 Alex Revo. All rights reserved.
 * @license    GPL v.3
 * @link       https://alexrevo.pw/
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\Registry\Registry;
use YOOtheme\Application;

class PlgSystemRevo_Less_Connector extends JPlugin
{

	public static $config;


	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);
		self::$config = &$this->params;
	}


	public function onAfterInitialise()
	{
		// Check if YOOtheme Pro is loaded
		if (!class_exists(Application::class, false)) {
			return;
		}
		$app = Application::getInstance();
		$app->load(__DIR__ . '/bootstrap.php');
	}
}
