<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin_nav_config_loaded'] = true;

$config['admin_menu_top'] = [
];

$config['admin_menu_side'] = [
    'Dashboard' => [
        'icon' => 'ri-home-smile-line',
        'title' => 'Home',
        'route' => '/admin/dashboard',
        'method' => 'dashboard',
        'router' => 'index',
        'params' => [
            'layout' => 'side-menu',
        ],
        'className' => [],
        'subMenu' => [],
    ],
	'Students' => [
		'icon' => 'ri-team-line',
		'title' => 'Students Management',
		'route' => '/admin/students',
		'params' => [
			'layout' => 'side-menu',
		],
		'className' => [],
		'subMenu' => [],
	],
    'Articles' => [
        'icon' => 'ri-team-line',
        'title' => 'Articles Management',
        'route' => '/admin/articles',
        'params' => [
            'layout' => 'side-menu',
        ],
        'className' => [],
        'subMenu' => [],
    ],
	'Notices' => [
		'icon' => 'ri-megaphone-line',
		'title' => 'Notices Management',
		'route' => '/admin/notices',
		'params' => [
			'layout' => 'side-menu',
		],
		'className' => [],
		'subMenu' => [],
	],
	'Inquiries' => [
		'icon' => 'ri-speak-line',
		'title' => 'Inquiries Management',
		'route' => '/admin/notices',
		'params' => [
			'layout' => 'side-menu',
		],
		'className' => [],
		'subMenu' => [],
	],
    'MyInfo' => [
        'icon' => 'ri-user-line',
        'title' => 'MyInfo Management',
        'route' => '/admin/MyInfo',
        'params' => [
            'layout' => 'side-menu',
        ],
        'className' => [],
        'subMenu' => [],
    ],
];
