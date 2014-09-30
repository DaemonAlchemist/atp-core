<?php

namespace ATPCore\View;

class Widget extends \Zend\View\Model\ViewModel
{
	protected $_template = "";
	
	public function __construct($params = null)
	{
		parent::__construct($params);
		
		$this->setTemplate($this->_template);
		
		$this->init();
	}
	
	protected function init()
	{
	}
	
	public function setOptions($options)
	{
		foreach($options as $option => $value)
		{
			$this->$option = $value;
		}
	}
	
	public function setVariable($name, $value)
	{
		parent::setVariable($name, $value);
		
		$func = "set" . ucfirst($name);
		if(method_exists($this, $func))
		{
			$this->$func($value);
		}
	}
}
