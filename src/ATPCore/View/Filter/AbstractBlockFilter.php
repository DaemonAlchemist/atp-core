<?php

namespace ATPCore\View\Filter;

class AbstractBlockFilter implements \Zend\Filter\FilterInterface
{
	private $_pattern = "/\{\{TYPE:(.*)\}\}/";
	protected $_type = "";

	private $_blocks = array();
	private $_sm = null;
	
	public function setServiceManager($sm)
	{
		$this->_sm = $sm;
	}
	
	public function getServiceManager()
	{
		return $this->_sm;
	}
	
	public function setType($type)
	{
		$this->_type = $type;
	}
	
	public function setClass($class)
	{
		$this->_class = $class;
	}
	
    public function filter($value)
    {
		while($this->_filter($value));
        return $value;
    }
	
	private function _filter(&$value)
	{
		$matches = null;
		preg_match_all($this->_getPattern(), $value, $matches);
		$blockNames = $matches[1];
		
		if(count($blockNames) == 0) return false;
		
		foreach($blockNames as $name)
		{
			if(!isset($this->_blocks[$name]))
			{
				$this->_blocks[$name] = $this->_loadObject($name);
			}
			$value = str_replace('{{' . $this->_type . ":" . $name . '}}', $this->_replace($this->_blocks[$name]), $value);
		}
		
		return true;
	}
	
	private function _getPattern()
	{
		return str_replace("TYPE", $this->_type, $this->_pattern);
	}
	
	protected function _loadObject($name)
	{
		return $name;
	}
	
	protected function _replace($block)
	{
		return "";
	}
}
