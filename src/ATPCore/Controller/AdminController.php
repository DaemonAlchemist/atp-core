<?php

namespace ATPCore\Controller;

class AdminController extends \ATPAdmin\Controller\IndexController
{
	public function parameterListAction()
	{
		$this->init();
		
		//Load the parameters
		$paramsRaw = $this->config('admin.parameters');
		$params = array();
		foreach($paramsRaw as $id => $param)
		{
			if(!isset($params[$param['group']])) $params[$param['group']] = array();
			$params[$param['group']][$id] = $param;
		}
		
		if(count($_POST))
		{
			foreach($_POST['params'] as $group => $postParams)
			{
				foreach($postParams as $id => $value)
				{
					$identifier = $params[$group][$id]['identifier'];
					$param = new \ATPCore\Model\Parameter();
					$param->loadByIdentifier($identifier);
					$param->value = $value;
					$param->save();
				}
			}
			$this->flash->addSuccessMessage("Module Parameters saved.");
		}
		
		//Load the objects
		$modelClass = $this->modelData['class'];
		$obj = new $modelClass();
		$objectsRaw = $obj->loadMultiple(null, array(), array(), $this->modelData['defaultOrder']);		
		$objects = array();
		foreach($objectsRaw as $object)
		{
			$objects[$object->identifier] = $object;
		}
		
		//Send data to the view
		$this->view->model = $this->modelType;
		$this->view->modelData = $this->modelData;
		$this->view->params = $params;
		$this->view->objects = $objects;
		
		return $this->view;
	}
}