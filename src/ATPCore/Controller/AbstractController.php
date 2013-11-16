<?php

namespace ATPCore\Controller;

class AbstractController extends \Zend\Mvc\Controller\AbstractActionController
{
	protected function get($resource)
	{
		return $this->getServiceLocator()->get($resource);
	}
	
	protected function config($path = null)
	{
		$parts = explode(".", $path);
		$config = $this->get('Config');
		if(empty($path)) return $config;
		
		foreach($parts as $part)
		{
			if(!isset($config[$part])) return null;
			$config = $config[$part];
		}
		
		return $config;
	}
}
