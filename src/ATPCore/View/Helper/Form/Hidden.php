<?php

namespace ATPCore\View\Helper\Form;

class Hidden extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$attributes = \ATP\MapReduce::get()
			->map(function($item, $index){return "{$index}=\"{$item}\"";})
			->reduce(new \ATP\Reducer\Concatenate(" "))
			->process($params);
	
		$html = "<input type=\"hidden\" {$attributes} />";
		
		return $html;
	}
}