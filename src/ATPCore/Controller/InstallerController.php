<?php

namespace ATPCore\Controller;

class InstallerController extends AbstractController
{
	protected $_isInstallerController = true;
	protected $_isUpdaterController = true;

	public function optionsAction()
	{
		$this->layout('layout/blank');
	
		$options = array();
		$modules = $this->config('modules');
		foreach($modules as $name => $moduleData)
		{
			$class = "{$name}\\Module";
			$module = new $class();
			$moduleOptions = $module->getInstallerOptions();
			if(count($moduleOptions)) $options[$name] = $moduleOptions;
		}
		
		return array(
			'options' => $options
		);
	}
	
	public function installAction()
	{
		$modules = $this->config('modules');
		
		//Move core module to front of the list
		$coreParams = $modules['ATPCore'];
		unset($modules['ATPCore']);
		$modules = array_merge(array('ATPCore' => $coreParams), $modules);
		
		foreach($modules as $name => $moduleData)
		{
			//Get the module
			$class = "{$name}\\Module";
			$module = new $class();
			$module->setServiceManager($this->getServiceLocator());
			
			//Install the module
			$params = isset($_POST[$name]) ? $_POST[$name] : array();
			$module->install($params);
			
			//Create the module entry in the Modules table
			$moduleEntry = new \ATPCore\Model\Module();
			$moduleEntry->name = $name;
			$moduleEntry->version = $moduleData['version'];
			$moduleEntry->save();
		}
		
		$this->redirect()->toRoute('home');
	}
	
	public function updateAction()
	{
		//echo 'Updater';die();
	}
}