<?php

namespace ATPCore\Model;

require_once("MenuItem.php");

class Menu extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return $this->name;
	}
	
	public function getMenuItems()
	{
		$item = new \ATPCore\Model\MenuItem();
		$items = $item->loadMultiple(array(
			'where' => 'menu_id = ?',
			'orderBy' => 'sort_order ASC',
			'data' => array($this->id),
		));
		return $items;
	}
}
Menu::init();