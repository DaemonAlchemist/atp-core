<?php

namespace ATPCore\View\Helper;

class AbstractCss extends \ATP\View\Helper
{
	protected $_function = "";

	public function __invoke($fileName)
	{
		//Preprocess .less files first
		$fileParts = explode(".", $fileName);
		$ext = array_pop($fileParts);
		
		if($ext == "less")
		{
			//Resolve asset
			$pluginManager = $this->getView()->getHelperPluginManager();
			$sm = $pluginManager->getServiceLocator();
			$assetManager = $sm->get('AssetManager\Service\AssetManager');
			$resolver = $assetManager->getResolver();
			$asset = $resolver->resolve($fileName);
			
			//Set original and compiled filenames
			$originalFile = $asset
				? $asset->getSourceDirectory() . '/' . $asset->getSourcePath()
				: getcwd() . "/public" . $fileName;
			$compiledFile = substr($originalFile, 0, -4) . "css";

			//Compile file
			$lessc = new \ATPCore\Lessc();
			$lessc->checkedCompile($originalFile, $compiledFile);
			
			//Set new filename
			$fileName = substr($fileName, 0, -4) . "css";
		}
	
		$func = $this->_function;
		$this->getView()->headLink()->$func($this->getView()->basePath() . $fileName);
		
		return $this->getView();
	}
}
