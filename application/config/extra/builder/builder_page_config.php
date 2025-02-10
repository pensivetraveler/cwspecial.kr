<?php
$config['builder_page_config_loaded'] = true;

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

$config['modal_base_config'] = array_replace_recursive($config['page_base_config'], [
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
