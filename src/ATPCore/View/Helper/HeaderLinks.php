<?php

namespace ATPCore\View\Helper;

class HeaderLinks extends \ATP\View\Helper
{
	private $_links = array();
	private $_title = "";
	
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
	
	public function setTitle($title)
	{
		$this->_title = $title;
	}
	
	public function __toString()
	{
		$html = "<div class=\"module-links\">";
		if(!empty($this->_title)) {
			$html .= "<h2>{$this->_title}</h2>";
		}
		
		if(count($this->_links) > 0) 
		{
			$html .= "<ul>";		
			foreach(array_reverse($this->_links) as $link)
			{
				$html .= "<li class=\"link\">";
				$html .= "<a href=\"{$link['url']}\">{$link['label']}</a>";
				$html .= "</li>\n";
			}		
			$html .= "</ul></div>";
		}
		
		return $html;
	}
}
