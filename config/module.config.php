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
                        'controller'    => 'ATPCore\Controller\ImageResize',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ATPCore\Controller\ImageResize' => 'ATPCore\Controller\ImageResize'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
			'ATPCore\Db' => function($sm)
			{
				return $sm->get('Zend\Db\Adapter\Adapter');
			},
            'Zend\Db\Adapter\Adapter' => function ($serviceManager) {
				$adapterFactory = new Zend\Db\Adapter\AdapterServiceFactory();
				$adapter = $adapterFactory->createService($serviceManager);
				\Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);

				return $adapter;
			},
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
