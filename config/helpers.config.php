<?php

return array(
	'block_filters' => array(
		'param' => 'ATPCore\View\Filter\Param',
		'url' => 'ATPCore\View\Filter\Url',
		'menu' => 'ATPCore\View\Filter\Menu',
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
			'formEnum' => 'ATPCore\View\Helper\Form\Enum',
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
