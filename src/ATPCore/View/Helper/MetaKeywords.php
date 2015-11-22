<?php

namespace ATPCore\View\Helper;

class MetaKeywords extends \ATP\View\Helper
{
	protected $_func = null;

	public function __invoke($keywords)
	{
		if(is_array($keywords)) $keywords = implode(", ", $keywords);
		
		$this->getView()->headMeta()->appendName('keywords', $keywords);
		
		return $this->getView();
	}
}
