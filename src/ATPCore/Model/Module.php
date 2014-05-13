<?php

namespace ATPCore\Model;

class Module extends \ATP\ActiveRecord
{
	protected function createDefinition()
	{
		$this->hasData('Name', 'IsActive', 'Version')
			->hasAdminColumns('Name', 'IsActive')
			->isIdentifiedBy('Name')
			->isOrderedBy('name ASC');
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
