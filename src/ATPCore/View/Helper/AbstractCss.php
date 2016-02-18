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
            if(getenv('APPLICATION_ENV') == 'development') {
                //Resolve asset
                $pluginManager = $this->getView()->getHelperPluginManager();
                $sm = $pluginManager->getServiceLocator();
                $assetManager = $sm->get('AssetManager\Service\AssetManager');
                $resolver = $assetManager->getResolver();
                $asset = $resolver->resolve($fileName);

                $config = $sm->get('Config');
                $paths = $config['asset_manager']['resolver_configs']['prioritized_paths'];
                $themeDir = null;
                try{
                    $param = new \ATPCore\Model\Parameter();
                    $param->loadByIdentifier('core-theme');
                    $themeDir = $param->value;
                } catch(\Exception $e) {
                }
                if(empty($themeDir)) $themeDir = "Default";
                $paths[] = array(
                    "path"		=> realpath("themes/{$themeDir}/public"),
                    "priority"	=> 5000
                );

                usort($paths, function($a, $b){
                    return $b['priority'] - $a['priority'];
                });

                $paths = \ATP\MapReduce::process(
                    $paths,
                    function($pathData) {
                        return array($pathData['path'] => '');
                    },
                    function($joined, $cur) {
                        return array_merge($joined, $cur);
                    },
                    array()
                );

                //Set original and compiled filenames
                $originalFile = $asset
                    ? $asset->getSourceDirectory() . '/' . $asset->getSourcePath()
                    : getcwd() . "/public" . $fileName;
                $compiledFile = substr($originalFile, 0, -4) . "css";

                //Initialize less compiler
                $lessc = new \Less_Parser();

                //Make the definitions file available to all less files
                $lessc->SetImportDirs($paths);

                //Compile the less code
                try {
                    set_time_limit(60);
                    $lessc->parseFile($originalFile);
                    file_put_contents($compiledFile, $lessc->getCss());
                } catch(\Exception $e) {
                    echo "Less compilation error while compiling <b>{$fileName}</b>: <br/>" . $e->getMessage(); die();
                }
            }

			//Set new filename
			$fileName = substr($fileName, 0, -4) . "css";
		}
	
		$func = $this->_function;
		$this->getView()->headLink()->$func($this->getView()->basePath() . $fileName);
		
		return $this->getView();
	}
}
