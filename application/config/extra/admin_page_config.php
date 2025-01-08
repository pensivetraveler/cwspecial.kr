<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin_page_config_loaded'] = true;

$config['admin_page_config'] = [
	'auth' => [
		'category' => 'auth',
		'type' => 'view',
		'properties' => [
			'baseMethod' => 'view',
			'includes' => [
				'head' => true,
				'header' => false,
				'modalPrepend' => false,
				'modalAppend' => false,
				'footer' => false,
				'tail' => true,
			],
		],
	],
	'dashboard' => [
		'category' => 'page',
		'type' => 'view',
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
		'type' => 'list',
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
		],
	],
	'students' => [
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
			'formConfig' => 'students',
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'students',
			'plugin' => 'datatable',
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
			'plugin' => 'datatable',
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
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'notices',
			'plugin' => 'datatable',
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
			'formType' => 'side',
		],
		'listProperties' => [
			'listConfig' => 'inquiries',
			'plugin' => 'datatable',
		],
	],
	'myinfo' => [
		'category' => 'page',
		'type' => 'view',
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
