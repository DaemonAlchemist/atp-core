<?php

namespace ATPCore\View\Helper\Form;

class Hidden extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$attributes = \ATP\MapReduce::process(
			$params,
			function($item, $index){return "{$index}=\"{$item}\"";},
			new \ATP\Reducer\Concatenate(" ")
		);
	
		$html = "<input type=\"hidden\" {$attributes} />";
		
		return $html;
	}
}