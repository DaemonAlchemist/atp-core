<?php

namespace ATPCore\View\Helper\Form;

class File extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$label = $params['label'];
		unset($params['label']);
		
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
			
		$html = "<label for=\"{$params['name']}\">{$label}</label>";
		$html .= "<input type=\"file\" {$attributes} />";
		
		return $html;
	}
}