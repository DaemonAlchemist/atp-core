<?php

namespace ATPCore;

class Module extends \ATP\Module
{
	protected $_moduleName = "ATPCore";
	
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'ATPCore\Db' => function($sm)
				{
					return $sm->get('Zend\Db\Adapter\Adapter');
				},
				'ATPCore\Model\Module' => function($sm)
				{
					$module = new \ATPCore\Model\Module($sm->get('ATPCore\Db'));
					return $module;
				}
			)
		);
	}
}
