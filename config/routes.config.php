<?php

return array(
    'router' => array(
        'routes' => array(
			'install' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/install[/:action[/]]',
					'defaults' => array(
						'controller' => 'atpcore-installer',
						'action' => 'options',
					),
				),
			),
            'imageResize' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/image-resize/:width/:height/:mode[/:base64ImagePath]',
                    'defaults' => array(
                        'controller'    => 'atpcore-image-resize',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
			'atpcore-installer' => 'ATPCore\Controller\InstallerController',
            'atpcore-image-resize' => 'ATPCore\Controller\ImageResizeController',
			'atpcore-admin' => 'ATPCore\Controller\AdminController',
        ),
    ),
);
