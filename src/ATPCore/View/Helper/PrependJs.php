<?php

namespace ATPCore\View\Helper;

class PrependJs extends \ATP\View\Helper
{
	public function __invoke($fileName)
	{
		$this->getView()->headScript()->prependFile($this->getView()->basePath() . $fileName);
		
		return $this->getView();
	}
}
