<?php

namespace ATPCore\View\Helper\Form;

class Date extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$label = $params['label'];
		unset($params['label']);
	
		$params['class'] = isset($params['class']) ? $params['class'] . ' date-field' : 'date-field';
	
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