<?php

namespace ATPCore\Model;

class Redirect extends \ATP\ActiveRecord
{
	protected function createDefinition()
	{
		$this->hasData('Name', 'SourcePattern', 'DestPattern', 'Priority', 'IsPermanent')
			->isIdentifiedBy('Name')
			->tableNamespace("core")
			->isOrderedBy('priority DESC, name ASC');
	}
	
	public static function redirect($path)
	{
		$where = '? REGEXP source_pattern';
		$redirect = new self();
		$redirects = $redirect->loadMultiple($where, array($path));
		if(count($redirects) > 0)
		{
			$redirect = current($redirects);
			$newPath = str_replace('{{path}}', $path, $redirect->destPattern);
			$code = $redirect->isPermanent ? "301 Moved Permanently" : "302 Found";
			header("HTTP/1.0 {$code}");
			header("Location: {$newPath}");
			echo "{$code}: <a href=\"{$newPath}\">{$newPath}</a>";
			die();
		}
	}
}
Redirect::init();