<?php

namespace ATPCore\Model;

class Parameter extends \ATP\ActiveRecord
{
	protected function setup()
	{
		$this->setTableNamespace("core");
	}
}
Parameter::init();