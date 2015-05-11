<?php

namespace ATPCore\View\Helper;

class AbstractJs extends \ATP\View\Helper
{
	protected $_func = null;

	public function __invoke($fileName)
	{
		//Only include files once
		static $existingJsFiles = array();
		if(in_array($fileName, $existingJsFiles)) return;
		$existingJsFiles[] = $fileName;
		
		$func = $this->_func;
		$this->getView()->headScript()->$func($this->getView()->basePath() . $fileName);
		
		return $this->getView();
	}
}
