<?php

namespace ATPCore\View\Filter;

class Param extends \ATPCore\View\Filter\AbstractBlockFilter
{
	protected function _loadObject($id)
	{
		return new \ATPCore\Model\Parameter($id);
	}
	
	protected function _replace($param)
	{
		return $param->value;
	}
}
