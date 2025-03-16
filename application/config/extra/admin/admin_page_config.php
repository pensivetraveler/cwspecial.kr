<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin_page_config_loaded'] = true;

$config['page_config'] = [
	'auth' => [
		'category' => 'auth',
		'type' => 'page',
		'properties' => [
			'baseMethod' => 'login',
			'allowNoLogin' => true,
			'includes' => [
				'head' => true,
				'header' => false,
				'modalPrepend' => true,
				'modalAppend' => false,
				'footer' => false,
				'tail' => true,
			],
		],
	],
	'dashboard' => [
		'category' => 'page',
		'type' => 'page',
		'subType' => 'dashboard',
		'properties' => [
			'baseMethod' => 'view',
			'allows' => ['view'],
			'formExist' => true,
		],
		'formProperties' => [
			'formConfig' => '',
			'formType' => '',
		],
	],
	'administrators' => [
		'category' => 'page',
		'type' => 'page',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','add','edit'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'administrators',
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'administrators',
			'plugin' => 'datatable',
			'buttons' => [
				'excel' => false,
			],
			'actions' => [
				'view' => false,
			],
		],
	],
	'students' => [
		'category' => 'page',
		'type' => 'page',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','add','edit'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'students',
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'students',
			'plugin' => 'datatable',
			'buttons' => [
				'excel' => false,
			],
			'actions' => [
				'view' => false,
			],
		],
	],
	'works' => [
		'category' => 'page',
		'type' => 'page',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','view'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'works',
			'formType' => 'page',
		],
		'listProperties' => [
			'listConfig' => 'works',
			'plugin' => 'datatable',
			'buttons' => [
				'add' => false,
				'excel' => false,
			],
			'actions' => [
				'edit' => false,
			],
		],
		'viewProperties' => [
			'viewType' => 'article',
			'isComments' => true,
		],
	],
	'notices' => [
		'category' => 'page',
		'type' => 'page',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','view'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'notices',
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'notices',
			'plugin' => 'datatable',
			'buttons' => [
				'excel' => false,
			],
			'actions' => [
			],
		],
		'viewProperties' => [
			'viewType' => 'article',
		],
	],
	'inquiries' => [
		'category' => 'page',
		'type' => 'page',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','view'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'inquiries',
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'inquiries',
			'plugin' => 'datatable',
			'buttons' => [
				'add' => false,
				'excel' => false,
			],
			'actions' => [
				'edit' => false,
			],
		],
		'viewProperties' => [
			'viewType' => 'article',
			'isComments' => true,
		]
	],
	'myinfo' => [
		'category' => 'page',
		'type' => 'page',
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
			'listConfig' => '',
			'plugin' => '',
		],
	],
];
