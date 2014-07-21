<?php

namespace ATPCore\View\Filter;

class Param extends \ATPCore\View\Filter\AbstractBlockFilter
{
	protected function _loadObject($id)
	{
		try {
			$param = new \ATPCore\Model\Parameter();
			if(!$param->loadByIdentifier($id))
			{
				$param->identifier = $id;
				$param->value = "{{$id} goes here}";
				$param->save();
			}
			return $param;
		} catch(\Exception $e) {
			$obj = new \stdClass();
			$obj->value = null;
			return $obj;
		}
	}
	
	protected function _replace($param)
	{
		return $param->value;
	}
}
