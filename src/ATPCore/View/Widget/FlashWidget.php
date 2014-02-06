<?php

namespace ATPCore\View\Widget;

class FlashWidget extends \ATPCore\View\Widget
{
	protected $_template = "atp-core/widget/flash.phtml";
	
	public function __construct($flash)
	{
		parent::__construct();
		$this->flash = $flash;
	}
}
