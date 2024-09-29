<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin_page_config_loaded'] = true;

$config['admin_page_base_config'] = [
	'category' => 'page',
	'type' => 'view',
	'subType' => 'base',
	'properties' => [
		'baseMethod' => 'view',
		'allows' => [],
		'noIndex' => false,
		'formExist' => false,
		'listExist' => false,
		'includes' => [
			'head' => true,
			'header' => true,
			'modalPrepend' => true,
			'modalAppend' => true,
			'footer' => true,
			'tail' => true,
		],
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

$config['admin_modal_base_config'] = [
	'category' => 'modal',
	'type' => 'view',
	'subType' => 'base',
	'properties' => [
		'baseMethod' => 'view',
		'allows' => [],
		'formExist' => false,
		'listExist' => false,
		'includes' => [
			'head' => false,
			'header' => false,
			'modalPrepend' => false,
			'modalAppend' => false,
			'footer' => false,
			'tail' => false,
		],
	],
	'formProperties' => [
		'formExist' => false,
		'listExist' => true,
		'formConfig' => '',
		'formType' => '',
	],
	'listProperties' => [
		'listConfig' => '',
	],
	'tabProperties' => [
		'tabGroup' => '',
	],
];

$config['admin_page_config'] = [
	'dashboard' => [
		'category' => 'page',
		'type' => 'view',
		'subType' => 'dashboard',
	],
	'students' => [
		'category' => 'page',
		'type' => 'list',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'students',
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'students',
			'listPlugin' => 'datatable',
		],
	],
	'works' => [
		'category' => 'page',
		'type' => 'list',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','add','edit'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'works',
			'formType' => 'page',
		],
		'listProperties' => [
			'listConfig' => 'works',
			'listPlugin' => 'datatable',
		],
	],
	'notices' => [
		'category' => 'page',
		'type' => 'list',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','add','edit'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'notices',
			'formType' => 'page',
		],
		'listProperties' => [
			'listConfig' => 'notices',
			'listPlugin' => 'datatable',
		],
	],
	'inquiries' => [
		'category' => 'page',
		'type' => 'list',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','add','edit'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'inquiries',
			'formType' => 'page',
		],
		'listProperties' => [
			'listConfig' => 'inquiries',
			'listPlugin' => 'datatable',
		],
	],
	'myinfo' => [
		'category' => 'page',
		'type' => 'edit',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'edit',
			'allows' => ['edit'],
			'formExist' => true,
			'listExist' => false,
		],
		'formProperties' => [
			'formConfig' => 'myinfo',
			'formType' => 'page',
		],
		'listProperties' => [
		],
	],
];
