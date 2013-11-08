<?php

namespace ATPCore;

class Module extends \ATP\Module
{
	protected $_moduleName = "ATPCore";
	protected $_moduleBaseDir = __DIR__;
	
    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
		// Set the db adapter so the models can find it.
        $sm = $e->getApplication()->getServiceManager();
		$adapter = $sm->get('ATPCore\Db');
        \ATP\ActiveRecord::setAdapter($adapter);
    }
}
