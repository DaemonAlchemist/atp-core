<?php

namespace ATPCore\Controller;

class AbstractController extends \Zend\Mvc\Controller\AbstractActionController
{
	public function get($resource)
	{
		return $this->getServiceLocator()->get($resource);
	}
}
