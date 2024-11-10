<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin_form_config_loaded'] = true;

$config['form_side_prefix'] = 'form_side-';
$config['form_page_prefix'] = 'form_page-';

$config['base_form_config'] = [
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
            'placeholder' => '아이디를 입력하세요',
        ],
        'form_attributes' => [
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

$config['form_students_config'] = [
	[
		'field' => 'student_id',
		'label' => 'lang:student.student_id',
		'form' => false,
		'list' => true,
	],
	[
		'field' => 'user_id',
		'label' => 'lang:user.user_id',
		'form' => false,
		'list' => true,
	],
	[
		'field' => 'code',
		'label' => 'lang:student.code',
		'form' => false,
		'list' => true,
	],
	[
		'field' => 'name',
		'label' => 'lang:user.name',
		'form' => false,
		'list' => true,
	],
	[
		'field' => 'id',
		'label' => 'lang:user.id',
		'form' => false,
		'list' => true,
	],
	[
		'field' => 'tel',
		'label' => 'lang:user.tel',
		'form' => false,
		'list' => true,
	],
//	[
//		'field' => 'write_count',
//		'label' => 'lang:user.write_count',
//		'form' => false,
//		'list' => true,
//	],
	[
		'field' => 'disabilities_yn',
		'label' => 'lang:user.disabilities_yn',
		'form' => false,
		'list' => true,
	],
	[
		'field' => 'aac_yn',
		'label' => 'lang:user.aac_yn',
		'form' => false,
		'list' => true,
	],
	[
		'field' => 'created_id',
		'label' => 'lang:common.created_id',
		'form' => false,
		'list' => false,
	],
	[
		'field' => 'recent_dt',
		'label' => 'lang:common.recent_dt',
		'form' => true,
		'rules' => 'trim',
		'errors' => [],
		'category' => 'basic',
		'type' => 'text',
		'subtype' => 'readonly',
		'icon' => 'ri-calendar-line',
		'form_text' => '',
		'attributes' => [
			'placeholder' => 'YYYY-MM-DD',
		],
		'form_attributes' => [
			'view_mod' => 'edit',
		],
		'default' => '',
		'list' => true,
		'list_attributes' => [],
	],
];
