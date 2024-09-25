<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$this->set_directory( "web" );
$route['default_controller'] = 'admin/index';
$route['except_folders'] = ['app', 'adm', 'admin', 'module'];

/*
|--------------------------------------------------------------------------
| WEB
|--------------------------------------------------------------------------
*/
$route['^(?!app|api|adm|admin|module).*'] = 'web/$0';

/*
|--------------------------------------------------------------------------
| MODULE
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/
$route['api/epClass/(:any)'] = "api/$1";
$route['api/epClass/(:any)/(:any)'] = "api/$1/$2";
$route['api/epClass/(:any)/(:any)/(:any)'] = "api/$1/$2/$3";

/*
|--------------------------------------------------------------------------
| APP
|--------------------------------------------------------------------------
*/
//$route['app/epFactory/(:any)'] = "app/$1";
//$route['app/epFactory/(:any)/(:any)'] = "app/$1/$2";
//$route['app/epNews/(:any)'] = "app/$1";
//$route['app/epNews/(:any)/(:any)'] = "app/$1/$2";
//$route['app/system/(:any)'] = "app/$1";
//$route['app/system/(:any)/(:any)'] = "app/$1/$2";

$route['app/epMagazine/(:any)'] = "app/$1";
$route['app/epMagazine/(:any)/(:any)'] = "app/$1/$2";
$route['app/epMagazine/(:any)/(:any)/(:any)'] = "app/$1/$2/$3";

$route['app/epCoaching/(:any)'] = "app/$1";
$route['app/epCoaching/(:any)/(:any)'] = "app/$1/$2";
$route['app/epCoaching/(:any)/(:any)/(:any)'] = "app/$1/$2/$3";

$route['app/epFactory/(:any)'] = "app/$1";
$route['app/epFactory/(:any)/(:any)'] = "app/$1/$2";
$route['app/epFactory/(:any)/(:any)/(:any)'] = "app/$1/$2/$3";

$route['app/epNews/(:any)'] = "app/$1";
$route['app/epNews/(:any)/(:any)'] = "app/$1/$2";
$route['app/epNews/(:any)/(:any)/(:any)'] = "app/$1/$2/$3";

$route['app/sys/(:any)'] = "app/$1";
$route['app/sys/(:any)/(:any)'] = "app/$1/$2";
$route['app/sys/(:any)/(:any)/(:any)'] = "app/$1/$2/$3";

//$route['app/epMagazine/knock/(:any)'] = "app/knock/$1";
//$route['app/epMagazine/knock/(:any)/(:any)'] = "app/knock/$1/$2";
//$route['app/epMagazine/magazine/(:any)'] = "app/magazine/$1";
//$route['app/epMagazine/magazine/(:any)/(:any)'] = "app/magazine/$1/$2";