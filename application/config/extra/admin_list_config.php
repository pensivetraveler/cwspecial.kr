<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['base_list_config'] = [
	[
		'list' => true,
		'field' => '',
		'label' => '',
		'format' => 'text',
		'icon' => '',
		'text' => '',
		'classes' => [],
		'onclick' => [],
		'render' => [],
		'options' => [],
	],
];

$config['list_students_config'] = [
	[
		'field' => 'student_id',
		'label' => 'lang:student.student_id',
	],
	[
		'field' => 'user_id',
		'label' => 'lang:user.user_id',
	],
	[
		'field' => 'code',
		'label' => 'lang:student.code',
	],
	[
		'field' => 'name',
		'label' => 'lang:user.name',
	],
	[
		'field' => 'id',
		'label' => 'lang:user.id',
	],
	[
		'field' => 'tel',
		'label' => 'lang:user.tel',
	],
	[
		'list' => false,
		'field' => 'write_count',
		'label' => 'lang:user.write_count',
	],
	[
		'field' => 'disabilities_yn',
		'label' => 'lang:user.disabilities_yn',
	],
	[
		'field' => 'aac_yn',
		'label' => 'lang:user.aac_yn',
	],
	[
		'list' => false,
		'field' => 'created_id',
		'label' => 'lang:common.created_id',
	],
	[
		'field' => 'recent_dt',
		'label' => 'lang:common.recent_dt',
	],
];
