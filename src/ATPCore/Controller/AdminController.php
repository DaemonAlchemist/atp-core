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
			$group = $param['group'];
			$subGroup = isset($param['subGroup']) ? $param['subGroup'] : 'General';
			if(!isset($params[$group])) $params[$group] = array();
			if(!isset($params[$group][$subGroup])) $params[$group][$subGroup] = array();
			$params[$group][$subGroup][$id] = $param;
		}
		
		//Sort groups
		ksort($params, SORT_STRING);
		foreach($params as &$group)
		{
			ksort($group, SORT_STRING);
		}
		
		if(count($_POST))
		{
			foreach($_POST['params'] as $group => $postParams)
			{
				foreach($postParams as $identifier => $value)
				{
					$param = new \ATPCore\Model\Parameter();
					$param->loadByIdentifier($identifier);
					$param->identifier = $identifier;
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