<?php
$config['buider_form_config_loaded'] = true;

$config['sample_form_config'] = [
	[
		'field' => 'field',
		'label' => 'lang:field',
		'form' => true,
		'rules' => 'trim|required',
		'errors' => [
			'required' => 'Enter the field'
		],
		'category' => 'basic',
		'type' => 'text',
		'subtype' => 'basic',
		'default' => 'sample',
		'icon' => 'ri-user-line',
		'form_text' => '영문, 숫자를 포함한 4글자 이상으로 입력해주세요.',
		'attributes' => [
			'autocapitalize' => 'none',
			'autocomplete' => 'off',
			'placeholder' => 'Enter The User ID',
		],
		'form_attributes' => [
			'editable' => true,
			'view_mod' => '',
			'with_btn' => true,
			'btn_type' => 'dup_check',
			'btn_params' => '{"key":"id", "title":"아이디"}',
			'text_type' => 'eng|num',
		],
		'option_attributes' => [
			'option_type' => 'db',
			'option_data' => [
				'table' => 'program',
				'params' => [],
			],
			'render' => [
				'id' => 'program_id',
				'text' => 'program_name',
			],
		],
		'group_key' => '',
		'group_attributes' => [
			'label' => 'lang:user.password',
			'form_text' => '',
			'type' => 'new_password',
		],
		'list' => true,
		'list_attributes' => [
			'format' => 'img',
			'icon' => 'ri-file-fill',
			'render' => [
				'callback' => 'articleListRender',
				'params' => [
					'article_cd' => 'ARC004',
				]
			]
		]
	],
];

