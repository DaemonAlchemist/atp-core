<?php

namespace ATPCore\View\Filter;

class Menu extends \ATPCore\View\Filter\AbstractBlockFilter
{
	protected function _loadObject($menuName)
	{
		return $menuName;
	}
	
	protected function _replace($menuName)
	{
		$menu = new \ATPCore\Model\Menu();
		$menu->loadByIdentifier($menuName);
		
		$items = $menu->getMenuItems();

		$vhm = $this->getServiceManager()->get('viewhelpermanager');
		$basePath = $vhm->get('basepath');
		
		$html = "<ul class=\"{$menuName}\">\n";
		foreach($items as $item)
		{
			$html .= "<li><a href=\"";
			$html .= ($item->localUrl) ? $basePath($item->url) : $item->url;
			$html .= "\">{$item->label}</a></li>\n";
		}
		$html .= "</ul>";
		
		return $html;
	}
}
