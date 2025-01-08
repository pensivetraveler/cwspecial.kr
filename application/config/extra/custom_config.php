<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['custom_config_loaded'] = true;

/*
|--------------------------------------------------------------------------
| LIFETIME CONFIG
|--------------------------------------------------------------------------
*/
$config['life_cycle'] = 'post_controller_constructor';
$config['loaded_views'] = [];
$config['error_occurs'] = false;

/*
|--------------------------------------------------------------------------
| PHPTOJS CONFIG
|--------------------------------------------------------------------------
*/
$config['phptojs']['namespace'] = "common";

/*
|--------------------------------------------------------------------------
| SMTP CONFIG
|--------------------------------------------------------------------------
*/
$config['smtp'] = array();
$config['smtp']['protocol'] = "smtp";
$config['smtp']['smtp_host'] = "smtp.naver.com";
$config['smtp']['smtp_port'] = "587";
$config['smtp']['smtp_user'] = "";
$config['smtp']['smtp_pass'] = "";
$config['smtp']['smtp_encryption'] = "tls";

/*
|--------------------------------------------------------------------------
| KAKAO LOGIN
|--------------------------------------------------------------------------
*/
$config['kakao_login'] = array();
$config['kakao_login']['callback_url'] = 'kakao/callback';
$config['kakao_login']['cliend_id'] = '';
$config['kakao_login']['secret'] = '';

/*
|--------------------------------------------------------------------------
| CUSTOM OPTIONS
|--------------------------------------------------------------------------
*/
$config['options'] = [
	'default' => [
		1 => 'Option 1',
		2 => 'Option 2',
	],
	'yn' => [
		0 => 'Y',
		1 => 'N',
	],
	'gender' => [
		'M' => '남',
		'F' => '여',
	],
	'grade' => [
		1 => '1학년',
		2 => '2학년',
		3 => '3학년',
		4 => '4학년',
	],
];
