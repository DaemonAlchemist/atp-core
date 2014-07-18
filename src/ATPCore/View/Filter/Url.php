<?php

namespace ATPCore\View\Filter;

class Url extends \ATPCore\View\Filter\AbstractBlockFilter
{
	protected function _loadObject($urlData)
	{
		return $urlData;
	}
	
	protected function _replace($urlData)
	{
		$vhm = $this->getServiceManager()->get('viewhelpermanager');
		$urlHelper = $vhm->get('url');
		
		$parts = explode(",", $urlData);
		$route = array_shift($parts);
		
		$params = array();		
		foreach($parts as $paramData)
		{
			list($var, $val) = explode("=>", $paramData);
			$params[$var] = $val;
		}
		
		return $urlHelper($route, $params);
	}
}
