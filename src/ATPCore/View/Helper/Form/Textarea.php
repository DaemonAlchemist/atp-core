<?php

namespace ATPCore\View\Helper\Form;

class Textarea extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$label = $params['label'];
		unset($params['label']);
		
		$text = isset($params['value']) ? $params['value'] : "";
		unset($params['value']);
	
		$attributes = \ATP\MapReduce::get()
			->map(function($item, $index){return "{$index}=\"{$item}\"";})
			->reduce(new \ATP\Reducer\Concatenate(" "))
			->process($params);
	
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<textarea {$attributes}>{$text}</textarea>";
		
		return $html;
	}
}