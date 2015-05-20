<?php

namespace ATPCore\Model;

require_once("Menu.php");

class MenuItem extends \ATP\ActiveRecord
{
	public function displayName()
	{
		return $this->label;
	}
}
MenuItem::init();