<?php

namespace ATPCore\View\Helper\Form;

class Text extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$label = $params['label'];
		unset($params['label']);

		$params['value'] = str_replace(array('{','}', '&'), array('\{', '\}', '&amp;'), $params['value']);	
		
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
	
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<input type=\"text\" {$attributes} />";
		
		return $html;
	}
}