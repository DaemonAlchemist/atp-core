<?php

namespace ATPCore\Model;

class Parameter extends \ATP\ActiveRecord
{
	protected function createDefinition()
	{
		$this->hasData('Identifier', 'Value')
			->isIdentifiedBy('Identifier')
			->tableNamespace("core");
	}
}
Parameter::init();