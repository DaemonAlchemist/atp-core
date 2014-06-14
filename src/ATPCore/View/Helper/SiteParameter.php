<?php

namespace ATPCore\View\Helper;

class SiteParameter extends \ATP\View\Helper
{
	public function __invoke($name)
	{
		$param = new \ATPCore\Model\Parameter();
		if(!$param->loadByIdentifier($name))
		{
			$param->identifier = $name;
			$param->value = "{{$name} goes here}";
			$param->save();
		}
		return $param->value;
	}
}
