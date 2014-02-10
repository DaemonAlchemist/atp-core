<?php

namespace ATPCore\View\Helper;

class HeaderLinks extends \ATP\View\Helper
{
	private $_links = array();
	
	public function __invoke($label = null, $url = null)
	{
		if(!is_null($label) && !is_null($url))
		{
			$this->_links[] = array(
				'label' => $label,
				'url' => $url
			);
		}
	
		return $this;
	}
	
	public function __toString()
	{
		$html = "<ul class=\"top-links\">";
		
		foreach(array_reverse($this->_links) as $link)
		{
			$html .= "<li class=\"link\">";
			$html .= "<a href=\"{$link['url']}\">{$link['label']}</a>";
			$html .= "</li>\n";
		}
		
		$html .= "</ul>";
		
		return $html;
	}
}
