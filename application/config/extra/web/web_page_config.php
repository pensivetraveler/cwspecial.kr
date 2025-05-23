<?php
$config['page_config_loaded'] = true;

$config['page_config'] = [
	'auth' => [
		'category' => 'auth',
		'type' => 'page',
		'properties' => [
			'baseMethod' => 'login',
			'allowNoLogin' => true,
		],
	],
	'works' => [
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
				'delete' => false,
			],
		],
		'viewProperties' => [
			'viewType' => 'article',
			'isComments' => true,
		],
	],
	'myworks' => [
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
			'formConfig' => 'works',
			'formType' => 'page',
		],
		'listProperties' => [
			'listConfig' => 'myworks',
			'plugin' => 'datatable',
			'buttons' => [
				'add' => true,
				'excel' => false,
			],
			'actions' => [

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
			'formType' => 'page',
		],
		'listProperties' => [
			'listConfig' => 'notices',
			'plugin' => 'datatable',
			'buttons' => [
				'add' => false,
				'excel' => false,
			],
			'actions' => [
				'edit' => false,
				'delete' => false,
			],
		],
		'viewProperties' => [
			'viewType' => 'article',
			'isComments' => false,
			'actions' => [
				'delete' => false,
			],
		],
	],
	'inquiries' => [
		'category' => 'page',
		'type' => 'page',
		'subType' => 'base',
		'properties' => [
			'baseMethod' => 'list',
			'allows' => ['list','view','add','edit'],
			'formExist' => true,
			'listExist' => true,
		],
		'formProperties' => [
			'formConfig' => 'inquiries',
			'formType' => 'page',
		],
		'listProperties' => [
			'listConfig' => 'inquiries',
			'plugin' => 'datatable',
			'buttons' => [
				'add' => true,
				'excel' => false,
			],
			'actions' => [
				'edit' => true,
				'view' => true,
				'delete' => true,
			],
		],
		'viewProperties' => [
			'viewType' => 'article',
			'isComments' => true,
		],
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
	],
];
