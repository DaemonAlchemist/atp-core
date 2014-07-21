<?php

namespace ATPCore\Controller;

class AbstractController extends \Zend\Mvc\Controller\AbstractActionController
{
	protected $_isInstallerController = false;
	protected $_isUpdaterController = false;

     public function onDispatch(\Zend\Mvc\MvcEvent $event)
	 {
		//Check if all modules are up-to-date
		$modules = $this->config('modules');
		foreach($modules as $name => $moduleData)
		{
			try {
				$module = new \ATPCore\Model\Module();
				$module->loadByName($name);
				
				if($moduleData['version'] != $module->version)
				{
					if(!$this->_isUpdaterController) $this->redirect()->toRoute('install', array('action' => 'update'));
				}
			} catch(\Exception $e) {
				if(!$this->_isInstallerController) $this->redirect()->toRoute('install', array('action' => 'options'));
			}
		}
	 
		//Detect redirects
		if(!$this->_isInstallerController && !$this->_isUpdaterController)
		{
			if($this->config('redirects.useRedirects'))
			{
				$uri = $event->getRequest()->getUri();
				\ATPCore\Model\Redirect::redirect($uri->getPath(), $uri->getQuery());
			}
		}

		//Proceed with page loading
		parent::onDispatch($event);
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
