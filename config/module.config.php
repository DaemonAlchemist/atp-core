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
			'atpcore_parameter' => array(
				'displayName' => 'Parameter',
				'class' => 'ATPCore\Model\Parameter',
				'category' => 'Admin',
				'displayColumns' => array('Identifier', 'Value'),
				'defaultOrder' => 'identifier ASC',
				'custom_actions' => array(
					'list' => array('controller' => 'core-admin', 'action' => 'parameter-list'),
				),
			),
			'atpcore_redirect' => array(
				'displayName' => 'Redirect',
				'class' => 'ATPCore\Model\Redirect',
				'category' => 'Admin',
				'displayColumns' => array('Name', 'SourcePattern', 'DestPattern'),
				'defaultOrder' => 'name ASC',
			),
		),
		'parameters' => array(
			'core-admin-title' => array(
				'identifier' => 'Admin Title',
				'group' => 'Core',
				'type' => 'Text',
				'default' => '&lt;Admin Title Goes Here&gt;',
			),
			'core-site-title' => array(
				'identifier' => 'Site Title',
				'group' => 'Core',
				'type' => 'Text',
				'default' => '&lt;Site Title Goes Here&gt;',
			),
			'core-site-title-sep' => array(
				'identifier' => 'Site Title Separator',
				'group' => 'Core',
				'type' => 'Text',
				'default' => ' - ',
			),
			'core-site-title' => array(
				'identifier' => 'Copyright Text',
				'group' => 'Layout',
				'type' => 'Text',
				'default' => 'Copyright ##DATE##',
			),
			'core-ga-key' => array(
				'identifier' => 'Google Analytics Key',
				'group' => 'Analytics',
				'type' => 'Text',
				'default' => '',
			),
			'core-ga-domain' => array(
				'identifier' => 'Google Analytics Domain',
				'group' => 'Analytics',
				'type' => 'Text',
				'default' => '',
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
                    'route'    => '/image-resize/:width/:height/:mode[/:base64ImagePath]',
                    'defaults' => array(
                        'controller'    => 'image-resize',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'image-resize' => 'ATPCore\Controller\ImageResizeController',
			'core-admin' => 'ATPCore\Controller\AdminController',
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
