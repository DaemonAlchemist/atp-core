<?php

namespace ATPCore\View\Helper;

class AbstractCss extends \ATP\View\Helper
{
	protected $_function = "";

	public function __invoke($fileName)
	{
		//Only include files once
		static $existingCssFiles = array();
		if(in_array($fileName, $existingCssFiles)) return;
		$existingCssFiles[] = $fileName;		
		
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

			//Initialize less compiler
			$lessc = new \ATPCore\Lessc();
			
			//Make the definitions file available to all less files
			$lessc->addImportDir($resolver->resolve("/css/definitions.less")->getSourceDirectory());
			
			//Compile the less code
			$lessc->checkedCompile($originalFile, $compiledFile);
			
			//Set new filename
			$fileName = substr($fileName, 0, -4) . "css";
		}
	
		$func = $this->_function;
		$this->getView()->headLink()->$func($this->getView()->basePath() . $fileName);
		
		return $this->getView();
	}
}
