<?php

namespace ATPCore\View\Helper\Form;

class Html extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$label = $params['label'];
		unset($params['label']);
		
		$text = isset($params['value']) ? $params['value'] : "";
		unset($params['value']);
	
		$text = str_replace(array('{','}'), array('\{', '\}'), $text);
	
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
	
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<textarea class=\"wysiwyg\" {$attributes}>{$text}</textarea>";
		
		return $html;
	}
}