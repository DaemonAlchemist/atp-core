<?php

namespace ATPCore\View\Helper\Form;

class Boolean extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$isChecked = $params['value'];
		unset($params['value']);
	
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
	
		$html = "<input type=\"hidden\" name=\"{$params['name']}\" value=\"0\"/>";
		$html .= "<label for=\"{$params['name']}\">{$params['label']}</label>";
		$html .= "<input type=\"checkbox\" {$attributes} " . ($isChecked ? "checked" : "") . " value=\"1\"/>";

		return $html;
	}
}