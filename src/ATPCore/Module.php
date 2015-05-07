<?php

namespace ATPCore;

class Module extends \ATP\Module
{
	protected $_moduleName = "ATPCore";
	protected $_moduleBaseDir = __DIR__;
	
    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
		$this->setServiceManager($sm);
		$config = $sm->get('Config');
		
		// Set the db adapter so the models can find it.
		$adapter = $sm->get('ATPCore\Db');
        \ATP\ActiveRecord::setAdapter($adapter);
		
		//Add filter hook to view renderer
		$vm = $sm->get('ViewManager');
		$renderer = $vm->getRenderer();
		
		//Add filters to renderer
		$filterChain = new \ATPCore\Filter\FilterChain();
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
	
	public function getInstallerOptions()
	{
		return array(
			'db_host' => array(
				'label' => 'Database Host',
				'type' => 'Text',
				'default' => 'localhost',
			),
			'db_schema' => array(
				'label' => 'Database Schema',
				'type' => 'Text',
				'default' => 'atp',
			),
			'db_user' => array(
				'label' => 'Database Username',
				'type' => 'Text',
				'default' => 'root',
			),
			'db_pass' => array(
				'label' => 'Database Password',
				'type' => 'Password',
				'default' => '',
			),
		);
	}
	
	public function install($options = array())
	{
		$config = $this->getServiceManager()->get('Config');
	
		//Setup database parameters
		$configFile = new \ATP\Config\File("config/autoload/global.php.blank");
		$configFile->apply($options);
		$configFile->save("config/autoload/global.php");
		
		//Setup a temp adapter for the ActiveRecord classes to use while installing
		$dbConfig = $config['db'];
		unset($dbConfig['database']);
		$dbConfig['host'] = $options['db_host'];
		$dbConfig['username'] = $options['db_user'];
		$dbConfig['password'] = $options['db_pass'];
		$adapter = new \Zend\Db\Adapter\Adapter($dbConfig);
		\ATP\ActiveRecord::setAdapter($adapter);
		
		//Create the database schema
		$adapter->query("CREATE DATABASE {$options['db_schema']}", \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
		
		//Add database to adapter
		$dbConfig['database'] = $options['db_schema'];
		$adapter = new \Zend\Db\Adapter\Adapter($dbConfig);
		\ATP\ActiveRecord::setAdapter($adapter);

		//Install database tables
		$this->installDatabaseEntries();
		
		//Reinitialize modules so its config is reloaded
		\ATPCore\Model\Module::init();
		
		//Set default parameters
		\ATPCore\Model\Parameter::init();
		foreach($config['admin']['parameters'] as $id => $paramData)
		{
			$param = new \ATPCore\Model\Parameter();
			$param->identifier = $id;
			$param->value = $paramData['default'];
			$param->save();
		}
	}
	
	protected function getInstallDbQueries()
	{
		return array(
			"CREATE TABLE `atpcore_modules` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
				`version` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
				`is_active` tinyint(1) DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `name_index` (`name`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
			
			"CREATE TABLE `atpcore_parameters` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`identifier` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
				`value` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
				PRIMARY KEY (`id`),
				UNIQUE KEY `identifier_UNIQUE` (`identifier`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
			
			"CREATE TABLE `atpcore_redirects` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` char(64) COLLATE utf8_unicode_ci DEFAULT NULL,
				`is_permanent` tinyint(1) NOT NULL DEFAULT '1',
				`priority` int(2) NOT NULL DEFAULT '0',
				`source_pattern` char(255) COLLATE utf8_unicode_ci NOT NULL,
				`dest_pattern` char(255) COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY (`id`),
				KEY `name_index` (`name`),
				KEY `source_index` (`source_pattern`),
				KEY `priority_index` (`priority`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci",
		);
	}
}
