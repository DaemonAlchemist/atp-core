<?php

namespace ATPCore\View\Helper;

class MetaDescription extends \ATP\View\Helper
{
	protected $_func = null;

	public function __invoke($description)
	{
		$this->getView()->headMeta()->appendName('description', $description);
		
		return $this->getView();
	}
}
