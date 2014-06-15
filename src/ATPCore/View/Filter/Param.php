<?php

namespace ATPCore\View\Filter;

class Param extends \ATPCore\View\Filter\AbstractBlockFilter
{
	protected function _loadObject($id)
	{
		$param = new \ATPCore\Model\Parameter();
		if(!$param->loadByIdentifier($id))
		{
			$param->identifier = $id;
			$param->value = "{{$id} goes here}";
			$param->save();
		}
		return $param;
	}
	
	protected function _replace($param)
	{
		return $param->value;
	}
}
