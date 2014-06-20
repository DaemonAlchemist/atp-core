<?php

namespace ATPCore\View\Helper;

class ImageResizePath extends \ATP\View\Helper
{
	public function __invoke($params)
	{
		$path = $params['path'];
		$width = $params['width'];
		$height = $params['height'];
		$mode = $params['mode'];
		$pathEncoded = base64_encode($path);
		
		return "/image-resize/{$width}/{$height}/{$mode}/{$pathEncoded}";
	}
}
