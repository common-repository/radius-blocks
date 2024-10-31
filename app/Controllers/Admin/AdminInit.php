<?php

namespace RadiusTheme\RB\Controllers\Admin;

use RadiusTheme\RB\Traits\SingletonTrait;
use RadiusTheme\RB\Controllers\Admin\DeActivePopup;

class AdminInit
{
	use SingletonTrait;

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		DeActivePopup::getInstance();
	}
}
