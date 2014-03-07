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
		
		//Detect redirects
		if($config['redirects']['useRedirects'])
		{
			$uri = $e->getRequest()->getUri();
			\ATPCore\Model\Redirect::redirect($uri->getPath(), $uri->getQuery());
		}
		
		//Add filter hook to view renderer
		$vm = $sm->get('ViewManager');
		$renderer = $vm->getRenderer();
		
		//Add filters to renderer
		$filterChain = new \Zend\Filter\FilterChain();
		$filters = isset($config['block_filters']) ? $config['block_filters'] : array();
		foreach($filters as $type => $class)
		{
			$filter = new $class();
			$filter->setServiceManager($sm);
			$filter->setType($type);
			$filter->setClass($class);
			$filterChain->attach($filter);
		}
		$renderer->setFilterChain($filterChain);
    }
}
