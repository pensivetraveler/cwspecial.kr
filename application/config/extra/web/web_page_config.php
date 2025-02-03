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
				'detail' => true,
				'delete' => true,
			],
		],
	],
];
