<?php

namespace ATPCore\View\Helper;

class SiteParameter extends \ATP\View\Helper
{
	public function __invoke($name)
	{
		$param = new \ATPCore\Model\Parameter($name);
		return $param->value;
	}
}
