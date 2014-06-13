<?php

namespace ATPCore\View\Helper\Form;

class ModelSelect extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$label = $params['label'];
		unset($params['label']);
	
		$className = $params['className'];
		unset($params['className']);
	
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
	
		$obj = new $className();
		$objects = $obj->loadMultiple();
		
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<select {$attributes}>";
		
		foreach($objects as $obj)
		{
			$selected = ($params['value'] == $obj->id) ? "selected" : "";
			$html .= "<option value=\"{$obj->id}\" {$selected}>{$obj->displayName()}</option>";
		}
		
		$html .= "</select>";
		
		return $html;
	}
}