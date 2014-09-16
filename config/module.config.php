<?php

return array(
	'modules' => array(
		'ATPCore' => array(
			'version' => '1.0',
		),
	),
	'image_resize' => array(
		'path' => 'images/resized/{encodedPath}/{id}_{width}_{height}_{mode}.png'
	),
	'db' => array(
		'driver'	=> 'Pdo_Mysql',
	),
	'redirects' => array(
		'useRedirects' => true,
	),
    'service_manager' => array(
        'factories' => array(
			'ATPCore\Db' => 'Zend\Db\Adapter\AdapterServiceFactory',
			'SessionManager' => 'ATPCore\Session\SessionManager',
        ),
    ),
	'session' => array(
		'config' => array(
			'class' => 'Zend\Session\Config\SessionConfig',
			'options' => array(
				'name' => 'ATP',
			),
		),
		'storage' => 'Zend\Session\Storage\SessionArrayStorage',
	),
);
