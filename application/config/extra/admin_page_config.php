<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin_page_config_loaded'] = true;

$config['admin_page_base_config'] = [
	'type' => 'index',
	'subtype' => 'base',
	'methods' => ['list','add','edit'],
	'modals' => [],
	'attributes' => [],
	'jsVars' => [],
	'afterLogin' => true,
];

$config['admin_page_config'] = [
	'Dashboard' => [
		'type' => 'page',
		'subtype' => 'dashboard',
		'methods' => ['index'],
		'attributes' => [],
		'afterLogin' => true,
	],
	'Students' => [
		'type' => 'page',
		'subtype' => 'list',
		'methods' => ['list'],
		'attributes' => [
			'sideForm' => true,
		],
		'afterLogin' => true,
	],
	'Works' => [
		'type' => 'page',
		'subtype' => 'list',
		'methods' => ['list','add','edit'],
		'attributes' => [
			'sideForm' => false,
		],
		'afterLogin' => true,
	],
	'Notices' => [
		'type' => 'page',
		'subtype' => 'list',
		'methods' => ['list','add','edit'],
		'attributes' => [
			'sideForm' => false,
		],
		'afterLogin' => true,
	],
	'Inquiries' => [
		'type' => 'page',
		'subtype' => 'list',
		'methods' => ['list','add','edit'],
		'attributes' => [
			'sideForm' => false,
		],
		'afterLogin' => true,
	],
	'MyInfo' => [
		'type' => 'page',
		'subtype' => 'system',
		'methods' => ['edit'],
		'attributes' => [],
		'afterLogin' => true,
	],
];
