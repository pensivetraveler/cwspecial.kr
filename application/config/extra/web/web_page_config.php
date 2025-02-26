<?php
$config['page_config_loaded'] = true;

$config['page_config'] = [
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
	],
	'notices' => [
		'category' => 'page',
		'type' => 'list',
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
				'view' => true,
				'delete' => false,
			],
		],
	],
	'inquiries' => [
		'category' => 'page',
		'type' => 'list',
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
				'edit' => false,
				'view' => true,
				'delete' => false,
			],
		],
	],
];
