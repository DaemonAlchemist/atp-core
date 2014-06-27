<?php

namespace ATPCore\Filter;

class FilterChain extends \Zend\Filter\FilterChain
{
	public function filter($value)
	{
		while($this->_filter($value));
		return $value;
	}
	
	public function _filter(&$value)
	{
		$filtered = parent::filter($value);
		$changed = $filtered != $value;
		$value = $filtered;
		return $changed;
	}
}
