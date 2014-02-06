<?php

namespace ATPCore\View;

class Widget extends \Zend\View\Model\ViewModel
{
	protected $_template = "";
	
	public function __construct($params = null)
	{
		parent::__construct($params);
		
		$this->setTemplate($this->_template);
	}
}
