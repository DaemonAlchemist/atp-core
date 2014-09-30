<?php

namespace ATPCore\View\Helper;

class AbstractJs extends \ATP\View\Helper
{
	protected $_func = null;

	public function __invoke($fileName)
	{
		$view = $this->getView();
		
		//Only include files once
		if(!isset($view->existingJsFiles)) $view->existingJsFiles = array();
		if(in_array($fileName, $view->existingJsFiles)) return;
		$this->existingJsFiles[] = $fileName;
		
		$func = $this->_func;
		$view->headScript()->$func($this->getView()->basePath() . $fileName);
		
		return $view;
	}
}
