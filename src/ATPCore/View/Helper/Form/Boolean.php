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
	
		$html = "<label for=\"{$params['name']}\">{$params['label']}</label>";
		$html .= "<select type=\"yes-no\" {$attributes}>";
		$html .= "<option value=\"1\" " . ($isChecked ? "selected" : "") . ">Yes</option>";
		$html .= "<option value=\"0\" " . (!$isChecked ? "selected" : "") . ">No</option>";
		$html .= "</select>";
	
		//$html = "<input type=\"hidden\" name=\"{$params['name']}\" value=\"0\"/>";
		//$html .= "<input class=\"checkbox\" type=\"checkbox\" {$attributes} " . ($isChecked ? "checked" : "") . " value=\"1\"/>";

		return $html;
	}
}