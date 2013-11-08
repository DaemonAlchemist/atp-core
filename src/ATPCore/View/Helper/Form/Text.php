<?php

namespace ATPCore\View\Helper\Form;

class Text extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$label = $params['label'];
		unset($params['label']);
	
		$attributes = \ATP\MapReduce::get()
			->map(function($item, $index){return "{$index}=\"{$item}\"";})
			->reduce(new \ATP\Reducer\Concatenate(" "))
			->process($params);
	
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<input type=\"text\" {$attributes} />";
		
		return $html;
	}
}