<?php

namespace ATPCore\Controller;

class AbstractController extends \Zend\Mvc\Controller\AbstractActionController
{
     public function onDispatch(\Zend\Mvc\MvcEvent $e)
	 {
		//Check to see if framework is installed
		
		//Check if all modules are up-to-date
	 
		//Detect redirects
		if($this->config('redirects.useRedirects'))
		{
			$uri = $e->getRequest()->getUri();
			\ATPCore\Model\Redirect::redirect($uri->getPath(), $uri->getQuery());
		}

		parent::onDispatch($e);
	 }


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
