<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
	'db' => array(
		'driver'	=> 'Pdo_Mysql',
	),
	'asset_manager' => array(
		'resolver_configs' => array(
			'paths' => array(
				__DIR__ . '/../public',
			),
		),
	),
    'router' => array(
        'routes' => array(
            'imageResize' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/atp-core/resize/:width/:height/:mode[/:base64ImagePath]',
                    'defaults' => array(
                        'controller'    => 'ATPCore\Controller\ImageResizeController',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ATPCore\Controller\ImageResizeController' => 'ATPCore\Controller\ImageResizeController'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
			'ATPCore\Db' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
	
	'view_helpers' => array(
		'invokables' => array(
			'formFile' => 'ATPCore\View\Helper\Form\File',
			'formHidden' => 'ATPCore\View\Helper\Form\Hidden',
			'formText' => 'ATPCore\View\Helper\Form\Text',
			'formTextarea' => 'ATPCore\View\Helper\Form\Textarea',
		)
	)
);
