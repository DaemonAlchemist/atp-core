<?php

namespace ATPCore\Model;

class Redirect extends \ATP\ActiveRecord
{
	public static function redirect($path, $query)
	{
		$request = $query ? "{$path}?{$query}" : $path;

		$where = '? REGEXP REPLACE(REPLACE(source_pattern, ")", ""), "(", "")';
		$redirect = new self();
		$redirects = $redirect->loadMultiple(array('where' => $where, 'data' => array($request), 'orderBy' => 'priority DESC, name ASC'));
		if(count($redirects) > 0)
		{
			$redirect = current($redirects);
            $pattern = $redirect->sourcePattern;
			$newPath = $redirect->destPattern;
            preg_match('/'.$pattern.'/', $request, $matches);
            print_r($matches);
			$newPath = str_replace('{{request}}', $request, $newPath);
			$newPath = str_replace('{{path}}', $path, $newPath);
			$newPath = str_replace('{{query}}', $query, $newPath);
            foreach($matches as $index => $text) {
                $newPath = str_replace('{{' . $index . '}}', $text, $newPath);
            }
			$code = $redirect->isPermanent ? "301 Moved Permanently" : "302 Found";
			header("HTTP/1.0 {$code}");
			header("Location: {$newPath}");
			echo "{$code}: <a href=\"{$newPath}\">{$newPath}</a>";
			die();
		}
	}
}
Redirect::init();