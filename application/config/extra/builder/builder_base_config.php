<?php
$config['builder_base_config_loaded'] = true;

$config['base_includes_config'] = [
	'head' => true,
	'header' => true,
	'modalPrepend' => true,
	'modalAppend' => true,
	'footer' => true,
	'tail' => true,
];

$config['page_base_config'] = [
	'category' => 'page',
	'type' => 'view',
	'subType' => 'base',
	'properties' => [
		'baseMethod' => 'view',
		'allows' => [],
		'noIndex' => false,
		'formExist' => false,
		'listExist' => false,
		'includes' => $config['base_includes_config'],
	],
	'formProperties' => [
		'formExist' => false,
		'formConfig' => '',
	],
	'listProperties' => [
		'listExist' => false,
		'listConfig' => '',
	],
	'tabProperties' => [
		'tabGroup' => '',
	],
];

$config['form_side_prefix'] = 'form_side-';
$config['form_page_prefix'] = 'form_page-';

$config['builder_nav_top_base'] = [

];

$config['builder_nav_side_base'] = [
	'code' => '',
	'icon' => '',
	'title' => 'Sample',
	'route' => '/admin/',
	'method' => 'dashboard',
	'router' => 'index',
	'params' => [
		'layout' => 'side-menu',
	],
	'className' => [],
	'authCheck' => false,
	'authParams' => [],
	'subMenu' => [],
];

$config['builder_nav_top_sample'] = [

];

$config['builder_nav_side_sample'] = [
	'dashboard' => [
		'icon' => 'ri-home-smile-line',
		'title' => 'Home',
		'route' => '/admin/dashboard',
		'method' => 'dashboard',
		'params' => [
			'layout' => 'side-menu',
		],
	],
	'welcome' => [
		'icon' => 'ri-user-line',
		'title' => 'Welcome',
		'route' => '',
		'method' => 'dashboard',
		'params' => [
			'layout' => 'side-menu',
		],
		'subMenu' => [
			'Welcome Sub 1' => [
				'icon' => '',
				'title' => 'Welcome Sub 1',
				'route' => '/admin/',
				'params' => [
					'welcome' => 1,
				],
				'className' => [],
			],
			'Welcome Sub 2' => [
				'icon' => '',
				'title' => 'Welcome Sub 2',
				'route' => '/admin/',
				'params' => [
					'welcome' => 2,
				],
				'className' => [],
			],

		],
	],
	'user' => [
		'icon' => 'ri-user-line',
		'title' => 'User',
		'route' => '/admin/users',
		'method' => 'dashboard',
		'params' => [
			'layout' => 'side-menu',
		],
	],

];

$config['builder_base_includes_config'] = [
	'head' => true,
	'header' => true,
	'modalPrepend' => true,
	'modalAppend' => true,
	'footer' => true,
	'tail' => true,
];

$config['builder_page_base_config'] = [
	'category' => 'page',
	'type' => 'view',
	'subType' => 'base',
	'properties' => [
		'baseMethod' => 'view',
		'allows' => [],
		'noIndex' => false,
		'formExist' => false,
		'listExist' => false,
		'includes' => $config['builder_base_includes_config'],
	],
	'formProperties' => [
		'formConfig' => '',
		'formType' => 'page',
	],
	'listProperties' => [
		'listConfig' => '',
		'plugin' => 'datatable',
		'buttons' => [
			'add' => true,
			'excel' => true,
		],
		'actions' => [
			'edit' => true,
			'view' => true,
			'delete' => true,
		],
	],
	'tabProperties' => [
		'tabGroup' => '',
	],
];

$config['builder_modal_base_config'] = array_replace_recursive($config['builder_page_base_config'], [
	'category' => 'modal',
	'properties' => [
		'includes' => [
			'head' => false,
			'header' => false,
			'modalPrepend' => false,
			'modalAppend' => false,
			'footer' => false,
			'tail' => false,
		],
	],
]);

$config['builder_form_base'] = [
	'field' => '',
	'label' => '',
	'form' => true,
	'rules' => '',
	'errors' => [],
	'category' => 'basic',
	'type' => 'text',
	'subtype' => 'basic',
	'default' => '',
	'icon' => null,
	'form_text' => '',
	'attributes' => [],
	'form_attributes' => [],
	'option_attributes' => [],
	'group' => '',
	'group_attributes' => [],
	'list' => false,
	'list_attributes' => [],
];

$config['builder_form_base_form_attributes'] = [
	'form_sync' => true,
	'reset_value' => true,
	'detect_changed' => true,
	'with_btn' => false,
	'with_list' => false,
	'list_sorter' => false,
	'list_onclick' => 'download',
	'list_delete' => false,
];

$config['builder_form_base_option_attributes'] = [
	'option_type' => 'field',
	'option_data' => [],
	'render' => [],
	'option_stack' => 'vertical',
];

$config['builder_form_base_group_attributes'] = [
	'label' => '',
	'form_text' => '',
	'type' => 'base',
	'key' => '',
	'envelope_name' => false,
	'group_repeater' => false,
	'repeater_type' => 'base',
	'repeater_id' => '',
	'repeater_count' => 1,
];

$config['builder_form_base_list_attributes'] = [
	'list' => true,
	'field' => '',
	'label' => '',
	'format' => 'text',
	'icon' => '',
	'text' => '',
	'classes' => [],
	'onclick' => [],
	'render' => [],
	'option_attributes' => [],
];

$config['builder_form_filter_base'] = [
	'field' => '',
	'label' => '',
	'category' => 'basic',
	'type' => 'text',
	'subtype' => 'basic',
	'default' => '',
	'icon' => null,
	'form_text' => '',
	'attributes' => [],
	'form_attributes' => [],
	'option_attributes' => [],
	'filter_attributes' => [
		'type' => 'where',
	],
];
