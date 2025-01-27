<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['admin_nav_config_loaded'] = true;

$config['admin_nav_top'] = [
];

$config['admin_nav_side'] = [
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
	'Administrators' => [
		'icon' => 'ri-team-line',
		'title' => 'Administrators Management',
		'route' => '/admin/administrators',
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
    'Works' => [
        'icon' => 'ri-team-line',
        'title' => 'Works Management',
        'route' => '/admin/works',
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
		'route' => '/admin/inquiries',
		'params' => [
			'layout' => 'side-menu',
		],
		'className' => [],
		'subMenu' => [],
	],
//    'MyInfo' => [
//        'icon' => 'ri-user-line',
//        'title' => 'MyInfo Management',
//        'route' => '/admin/MyInfo',
//        'params' => [
//            'layout' => 'side-menu',
//        ],
//        'className' => [],
//        'subMenu' => [],
//    ],
];
