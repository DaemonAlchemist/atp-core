<?php

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
					'list' => array('controller' => 'atpcore-admin', 'action' => 'parameter-list'),
				),
			),
			'atpcore_redirect' => array(
				'displayName' => 'Redirect',
				'class' => 'ATPCore\Model\Redirect',
				'category' => 'Admin',
				'displayColumns' => array('Name', 'SourcePattern', 'DestPattern'),
				'defaultOrder' => 'name ASC',
				'tabs' => array(
					'Details' => array('name', 'is_permanent'),
					'Patterns' => array('source_pattern', 'dest_pattern'),
				),
			),
			'atpcore_module' => array(
				'displayName' => 'Module',
				'class' => 'ATPCore\Model\Module',
				'category' => 'Admin',
				'displayColumns' => array('Version', 'IsActive'),
				'defaultOrder' => 'name ASC',
			),
		),
		'parameters' => array(
			'core-admin-title' => array(
				'displayName' => 'Admin Title',
				'group' => 'Core',
				'type' => 'Text',
				'default' => 'ATP Admin',
			),
			'core-site-title' => array(
				'displayName' => 'Site Title',
				'group' => 'Core',
				'type' => 'Text',
				'default' => 'ATP Framework',
			),
			'core-site-title-sep' => array(
				'displayName' => 'Site Title Separator',
				'group' => 'Core',
				'type' => 'Text',
				'default' => ' - ',
			),
			'core-theme' => array(
				'displayName' => 'Theme',
				'group' => 'Layout',
				'type' => 'Enum',
				'default' => 'Default',
				'options' => array(
				),
			),
			'core-site-banner' => array(
				'displayName' => 'Site Banner',
				'group' => 'Layout',
				'type' => 'ModelSelect',
				'default' => '',
				'options' => array(
					'className' => 'ATPCms\Model\Image',
				),
			),
			'core-site-copyright' => array(
				'displayName' => 'Copyright Text',
				'group' => 'Layout',
				'type' => 'Text',
				'default' => 'Copyright #DATE#',
			),
			'core-ga-key' => array(
				'displayName' => 'Google Analytics Key',
				'group' => 'Analytics',
				'type' => 'Text',
				'default' => '',
			),
			'core-ga-domain' => array(
				'displayName' => 'Google Analytics Domain',
				'group' => 'Analytics',
				'type' => 'Text',
				'default' => '',
			),
			'core-session-namespace' => array(
				'displayName' => 'Session Namespace',
				'group' => 'Core',
				'type' => 'Text',
				'default' => '',
			),
		),
	),
);
