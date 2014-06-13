<?php

namespace ATPCore\Model;

class Module extends \ATP\ActiveRecord
{
	protected function createDefinition()
	{
		$this->setTableNamespace('core');
	}
	
	public function getActiveModules()
	{
		return $this->loadMultiple("is_active = 1");
	}
	
	public function getActiveModuleNames()
	{
		$names = array();
		foreach($this->getActiveModules() as $module)
		{
			$names[] = $module->name;
		}
		
		return $names;
	}
}
Module::init();
