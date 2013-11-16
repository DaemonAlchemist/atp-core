<?php

namespace ATPCore\Controller;

class ImageResizeController extends AbstractController
{
	public function indexAction()
	{
		//Get original image info
		$filePathEncoded = $this->params('base64ImagePath');
		$filePath = getcwd() . "/public" . base64_decode($filePathEncoded);
		$id = md5(filesize($filePath));
		
		//Get the transform parameters
		$width = $this->params('width');
		$height = $this->params('height');
		$mode = strtolower($this->params('mode'));
		
		//Determine the cached image path
		$cachedImagePath = getcwd() . "/public/images/resized/{$filePathEncoded}/{$id}_{$width}_{$height}_{$mode}.png";
		
		if(file_exists($cachedImagePath))
		{
			$content = file_get_contents($cachedImagePath);
		}
		else
		{
			//Load the image from Imagine
			$imagine = new \Imagine\Gd\Imagine;
			$image = $imagine->open($filePath);

			//Get the image's original size
			$size = $image->getSize();
			
			//Scale appropriately by mode
			switch($mode)
			{
				case "bywidth":	$height = $width / $size->getWidth() * $size->getHeight(); break;
				case "byheight": $width = $height / $size->getHeight() * $size->getWidth(); break;
				case "fit":
					$scale = min($width / $size->getWidth, $height / $size->getHeight());
					$width = $scale * $size->getWidth();
					$height = $scale * $size->getHeight();
					break;
				case "exact":
					//Nothing to do, keep original sizes
					break;
			}
			
			//Apply the transformation
			$transformation = new \Imagine\Filter\Transformation();
			$transformation->thumbnail(new \Imagine\Image\Box($width, $height));
			$image = $transformation->apply($image);
			
			//Get the image content
			$content = $image->get('png');
			
			//Cache the image content
			$dir = dirname($cachedImagePath);
			if(!is_dir($dir)) mkdir($dir, 0755, true);
			file_put_contents($cachedImagePath, $content);
		}

		//Output the image
		$response = $this->getResponse();
		$response->setContent($content);
		$response
			->getHeaders()
			->addHeaderLine('Content-Transfer-Encoding', 'binary')
			->addHeaderLine('Content-Type', 'image/png')
			->addHeaderLine('Content-Length', mb_strlen($content));

		return $response;
	}
}