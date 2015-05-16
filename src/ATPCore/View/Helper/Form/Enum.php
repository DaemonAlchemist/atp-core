<?php

namespace ATPCore\View\Helper\Form;

class Enum extends \ATP\View\Helper
{
	public function __invoke($params, $options)
	{
		$label = $params['label'];
		unset($params['label']);
	
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
	
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<select {$attributes}>";
		
		$selected = (empty($obj->id)) ? "selected" : "";
		$html .= "<option value=\"\" {$selected}>- Select an option -</option>";
		foreach($options as $option)
		{
			$selected = (strtolower($params['value']) == strtolower($option)) ? "selected" : "";
			$html .= "<option value=\"{$option}\" {$selected}>{$option}</option>";
		}
		
		$html .= "</select>";
		
		return $html;
	}
}