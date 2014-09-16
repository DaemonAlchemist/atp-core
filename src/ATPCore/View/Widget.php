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
	
	public function setOptions($options)
	{
		foreach($options as $option => $value)
		{
			$this->$option = $value;
		}
	}
}
