<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
	'admin' => array(
		'models' =>array(
			'core_parameter' => array(
				'displayName' => 'Parameter',
				'class' => 'ATPCore\Model\Parameter',
				'category' => 'Admin',
				'displayColumns' => array('Identifier', 'Value'),
				'defaultOrder' => 'identifier ASC',
				'fields' => array(
					'Identifier' => array(
						'type' => 'Text',
						'label' => 'Identifier'
					),
					'Value' => array(
						'type' => 'Text',
						'label' => 'Value',
					),
				),
			),
			'core_redirect' => array(
				'displayName' => 'Redirect',
				'class' => 'ATPCore\Model\Redirect',
				'category' => 'Admin',
				'displayColumns' => array('Name', 'SourcePattern', 'DestPattern'),
				'defaultOrder' => 'name ASC',
				'fields' => array(
					'Name' => array(
						'type' => 'Text',
						'label' => 'Name',
					),
					'SourcePattern' => array(
						'type' => 'Text',
						'label' => 'Source Pattern',
					),
					'DestPattern' => array(
						'type' => 'Text',
						'label' => 'Destination Pattern',
					),
					'Priority' => array(
						'type' => 'Text',
						'label' => 'Priority',
					),
					'IsPermanent' => array(
						'type' => 'Boolean',
						'label' => 'Permanent Redirect',
					),
				),
			),
		),
	),
	'image_resize' => array(
		'path' => 'images/resized/{encodedPath}/{id}_{width}_{height}_{mode}.png'
	),
	'db' => array(
		'driver'	=> 'Pdo_Mysql',
	),
	'block_filters' => array(
		'param' => 'ATPCore\View\Filter\Param',
	),
	'redirects' => array(
		'useRedirects' => true,
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
	'view_helpers' => array(
		'invokables' => array(
			'siteParam' => 'ATPCore\View\Helper\SiteParameter',
			
			'resize' => 'ATPCore\View\Helper\ImageResizePath',
			
			'breadcrumbs' => 'ATPCore\View\Helper\Breadcrumbs',
			'headerLinks' => 'ATPCore\View\Helper\HeaderLinks',
			'pageType' => 'ATPCore\View\Helper\PageType',
			
			'formBoolean' => 'ATPCore\View\Helper\Form\Boolean',
			'formDate' => 'ATPCore\View\Helper\Form\Date',
			'formFile' => 'ATPCore\View\Helper\Form\File',
			'formHidden' => 'ATPCore\View\Helper\Form\Hidden',
			'formModelSelect' => 'ATPCore\View\Helper\Form\ModelSelect',
			'formPassword' => 'ATPCore\View\Helper\Form\Password',
			'formText' => 'ATPCore\View\Helper\Form\Text',
			'formTextarea' => 'ATPCore\View\Helper\Form\Textarea',
			'formHtml' => 'ATPCore\View\Helper\Form\Html',
			
			'appendJs' => 'ATPCore\View\Helper\AppendJs',
			'prependJs' => 'ATPCore\View\Helper\PrependJs',
			'appendCss' => 'ATPCore\View\Helper\AppendCss',
			'prependCss' => 'ATPCore\View\Helper\PrependCss',
		)
	)
);
