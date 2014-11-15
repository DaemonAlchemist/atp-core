<?php

namespace ATPCore\Controller;

class AbstractController extends \Zend\Mvc\Controller\AbstractActionController
{
	protected $_isInstallerController = false;
	protected $_isUpdaterController = false;
	
	protected $remember = null;

	public function onDispatch(\Zend\Mvc\MvcEvent $event)
	{
		//Set the default time zone
		date_default_timezone_set($this->config('timeZone'));

		$this->_checkForUpdates();
		$this->_checkForRedirects($event);
		$this->_initLayout();

		//Setup the session
		$namespace = $this->siteParam('core-session-namespace');
		$this->remember = new \Zend\Session\Container();
		
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
	
	protected function siteParam($name)
	{
		$param = new \ATPCore\Model\Parameter();
		$param->loadByIdentifier($name);
		
		//Param does not exist, set default
		if(!$param->id)
		{
			$param->identifier = $name;
			$param->value = $this->config("admin.parameters.{$name}.default");
			$param->save();
		}
		
		return $param->value;
	}
	
	private function _checkForUpdates()
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
					//Temporarilly disable updater
					//if(!$this->_isUpdaterController) $this->redirect()->toRoute('install', array('action' => 'update'));
				}
			} catch(\Exception $e) {
				if(!$this->_isInstallerController) $this->redirect()->toRoute('install', array('action' => 'options'));
			}
		}
	}
	
	private function _checkForRedirects($event)
	{
		$request = $event->getRequest();
		if($request instanceof \Zend\Console\Request) return;
	
		if(!$this->_isInstallerController && !$this->_isUpdaterController)
		{
			if($this->config('redirects.useRedirects'))
			{
				$uri = $event->getRequest()->getUri();
				\ATPCore\Model\Redirect::redirect($uri->getPath(), $uri->getQuery());
			}
		}
	}

	private function _initLayout()
	{
		$layout = $this->config('layout');
		
		//Init blocks
		if(isset($layout['global']['blocks']))
		{
			foreach($layout['global']['blocks'] as $blockName => $blockData)
			{
				$class = $layout['blocks'][$blockName];
				$block = new $class();
				$options = array();
				foreach($blockData['options'] as $optionName => $optionValueData)
				{
					$type = $optionValueData[0];
					$id = $optionValueData[1];
					switch($type)
					{
						case 'siteParam':	$options[$optionName] = $this->siteParam($id);	break;
						default:			$options[$optionName] = $id;					break;
					}
				}
				$block->setOptions($options);
				$this->layout()->addChild($block, $blockName);
			}
		}
	}
}
