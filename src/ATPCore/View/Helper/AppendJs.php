<?php

namespace ATPCore\View\Helper;

class AppendJs extends \ATP\View\Helper
{
	public function __invoke($fileName)
	{
		$this->getView()->headScript()->appendFile($this->getView()->basePath() . $fileName);
		
		return $this->getView();
	}
}
