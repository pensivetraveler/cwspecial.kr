<?php
$config['buider_base_config_loaded'] = true;

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
