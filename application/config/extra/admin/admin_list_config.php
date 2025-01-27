<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['admin_list_config_loaded'] = true;

$config['list_administrators_config'] = [
	[
		'field' => 'id',
		'label' => 'lang:user.id',
	],
	[
		'field' => 'name',
		'label' => 'lang:user.name',
	],
	[
		'field' => 'email',
		'label' => 'lang:user.email',
	],
	[
		'field' => 'tel',
		'label' => 'lang:user.tel',
	],
	[
		'field' => 'recent_dt',
		'label' => 'lang:common.recent_dt',
	],
];

$config['list_students_config'] = [
	[
		'field' => 'id',
		'label' => 'lang:user.id',
	],
	[
		'field' => 'name',
		'label' => 'lang:user.name',
	],
	[
		'field' => 'email',
		'label' => 'lang:user.email',
	],
	[
		'field' => 'tel',
		'label' => 'lang:user.tel',
	],
	[
		'field' => 'code',
		'label' => 'lang:student.code',
	],
	[
		'field' => 'grade',
		'label' => 'lang:student.grade',
	],
	[
		'field' => 'recent_dt',
		'label' => 'lang:common.recent_dt',
	],
];

$config['list_works_config'] = [
	[
		'field' => 'subject',
		'label' => 'lang:article.subject',
	],
	[
		'field' => 'created_id',
		'label' => 'lang:common.created_id',
	],
	[
		'field' => 'recent_dt',
		'label' => 'lang:common.recent_dt',
	],
	[
		'field' => 'view_count',
		'label' => 'lang:article.view_count',
	],
];

$config['list_notices_config'] = [
	[
		'field' => 'subject',
		'label' => 'lang:article.subject',
	],
	[
		'field' => 'created_id',
		'label' => 'lang:common.created_id',
	],
	[
		'field' => 'recent_dt',
		'label' => 'lang:common.recent_dt',
	],
];

$config['list_inquiries_config'] = [
	[
		'field' => 'subject',
		'label' => 'lang:article.subject',
	],
	[
		'field' => 'content',
		'label' => 'lang:article.content',
	],
	[
		'field' => 'created_id',
		'label' => 'lang:common.created_id',
	],
	[
		'field' => 'recent_dt',
		'label' => 'lang:common.recent_dt',
	],
];
