<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_platform'] = 'web';
$route['default_controller'] = 'common';
$route['default_controller_filename'] = preg_replace('/' . preg_quote(substr($route['default_controller'],0,1), '/') . '/', strtoupper(substr($route['default_controller'],0,1)), $route['default_controller'], 1).'.php';
$route['except_folders'] = ['app', 'adm', 'admin', 'module', 'web', 'api'];
array_splice($route['except_folders'], array_search($route['default_platform'], $route['except_folders']), 1);
$route['except_routes'] = join('|', array_merge($route['except_folders']));

foreach ($route['except_folders'] as $name) {
	if(!file_exists(APPPATH.'controllers'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.$route['default_controller_filename'])){
		$route[$name] = function() {
			show_404();
		};
	}else{
		$route[$name] = $name.DIRECTORY_SEPARATOR.$route['default_controller'];
		$route["$name/(:any)"] = "$name/$1/index";
	}
}

/*
|--------------------------------------------------------------------------
| WEB
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
$route['admin/api/(:any)/(:any)'] = 'api/$1/$2';

/*
|--------------------------------------------------------------------------
| APP
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| MODULE
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Default Platform
|--------------------------------------------------------------------------
 */
if($route['default_platform']) {
	// 숫자와 매칭되는 웹 경로
	$route["(?!{$route['except_routes']})([^/]+)/(:num)"] = 'web/$1/index/$2';
	$route["(?!{$route['except_routes']})([^/]+)/(:any)/(:any)"] = 'web/$1/$2/$3';
	// 포괄적인 웹 경로 (마지막에 선언)
	$route["(?!{$route['except_routes']}).*"] = 'web/$0';
	$route['default_controller'] = $route['default_platform'].DIRECTORY_SEPARATOR.$route['default_controller'];
}
