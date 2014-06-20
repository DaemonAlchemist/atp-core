<?php

namespace ATPCore\Model;

class Redirect extends \ATP\ActiveRecord
{
	public static function redirect($path, $query)
	{
		$request = "{$path}?{$query}";
	
		$where = '? REGEXP source_pattern';
		$redirect = new self();
		$redirects = $redirect->loadMultiple(array('where' => $where, 'data' => array($request), 'orderBy' => 'priority DESC, name ASC'));
		if(count($redirects) > 0)
		{
			$redirect = current($redirects);
			$newPath = $redirect->destPattern;
			$newPath = str_replace('{{request}}', $request, $newPath);
			$newPath = str_replace('{{path}}', $path, $newPath);
			$newPath = str_replace('{{query}}', $query, $newPath);
			$code = $redirect->isPermanent ? "301 Moved Permanently" : "302 Found";
			header("HTTP/1.0 {$code}");
			header("Location: {$newPath}");
			echo "{$code}: <a href=\"{$newPath}\">{$newPath}</a>";
			die();
		}
	}
}
Redirect::init();