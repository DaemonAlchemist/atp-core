<?php

namespace ATPCore\View\Helper;

class PageType extends \ATP\View\Helper
{
	private $_type = "";
	
	public function __invoke($type = null)
	{
		if(!empty($type)) $this->_type = $type;
	
		return $this;
	}
	
	public function __toString()
	{
		return $this->_type;
	}
}
