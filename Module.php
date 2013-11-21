<?php

namespace ATPCore;

class Module extends \ATP\Module
{
	protected $_moduleName = "ATPCore";
	protected $_moduleBaseDir = __DIR__;
	
    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
		$config = $sm->get('Config');
		
		// Set the db adapter so the models can find it.
		$adapter = $sm->get('ATPCore\Db');
        \ATP\ActiveRecord::setAdapter($adapter);
		
		//Add filter hook to view renderer
		$vm = $sm->get('ViewManager');
		$renderer = $vm->getRenderer();
		
		//Add filters to renderer
		$filterChain = new \Zend\Filter\FilterChain();
		$filters = isset($config['view_filters']) ? $config['view_filters'] : array();
		foreach($filters as $filterClass => $options)
		{
			$filterChain->attach(new $filterClass($options));
		}
		$renderer->setFilterChain($filterChain);
    }
}
