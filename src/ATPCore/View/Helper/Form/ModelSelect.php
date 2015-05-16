<?php

namespace ATPCore\View\Helper\Form;

class ModelSelect extends \ATP\View\Helper
{
	public function __invoke($params, $options)
	{
		$label = $params['label'];
		unset($params['label']);
	
		$className = $options['className'];
	
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
	
		$obj = new $className();
		$objects = $obj->loadMultiple();
		
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<select {$attributes}>";
		
		$selected = (empty($obj->id)) ? "selected" : "";
		$html .= "<option value=\"\" {$selected}>- Select an option -</option>";
		foreach($objects as $obj)
		{
			$selected = ($params['value'] == $obj->id) ? "selected" : "";
			$html .= "<option value=\"{$obj->id}\" {$selected}>{$obj->displayName()}</option>";
		}
		
		$html .= "</select>";
		
		return $html;
	}
}