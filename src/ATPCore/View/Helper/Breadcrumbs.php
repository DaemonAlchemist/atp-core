<?php

namespace ATPCore\View\Helper;

class Breadcrumbs extends \ATP\View\Helper
{
	private $_links = array();
	
	public function __invoke($label, $url)
	{
		$this->_links[] = array(
			'label' => $label,
			'url' => $url
		);
	
		return $this;
	}
	
	public function __toString()
	{
		$html = "<ul class=\"bread-crumbs\">";
		
		foreach(array_reverse($this->_links) as $link)
		{
			$html .= "<li>";
			$html .= "<a href=\"{$link['url']}\">{$link['label']}</a>";
			$html .= "</li>\n";
		}
		
		$html .= "</ul>";
		
		return $html;
	}
}
