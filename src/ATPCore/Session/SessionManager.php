<?php

namespace ATPCore\Session;

class SessionManager extends \Zend\Session\SessionManager implements \Zend\ServiceManager\FactoryInterface
{
	private $_sm = null;
	
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $sm)
	{
		$config = $sm->get('config');
        if (isset($config['session'])) {
			$session = $config['session'];

			$sessionConfig = null;
			if (isset($session['config'])) {
				$class = isset($session['config']['class'])  ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
				$options = isset($session['config']['options']) ? $session['config']['options'] : array();
				$sessionConfig = new $class();
				$sessionConfig->setOptions($options);
			}

			$sessionStorage = null;
			if (isset($session['storage'])) {
				$class = $session['storage'];
				$sessionStorage = new $class();
			}

			$sessionSaveHandler = null;
			if (isset($session['save_handler'])) {
				// class should be fetched from service manager since it will require constructor arguments
				$sessionSaveHandler = $sm->get($session['save_handler']);
			}

			$sessionManager = new self($sessionConfig, $sessionStorage, $sessionSaveHandler);
		} else {
			$sessionManager = new self();
		}
		
		\Zend\Session\Container::setDefaultManager($sessionManager);
		return $sessionManager;
	}
}