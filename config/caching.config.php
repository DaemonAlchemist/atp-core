<?php
return array(
    'strokercache'    => array(
        'storage_adapter' => array(
            'name' => 'Zend\Cache\Storage\Adapter\Filesystem',
			'options' => array(
				'file_permission' => 0660,
			),
        ),
	),
);
