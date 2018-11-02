<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'login/process_logout';
$route['users'] = 'user/index';
$route['users/page/(:num)'] = 'user/index/$1';
$route['users/page'] = 'user/index';
$route['user/delete/(:any)'] = 'user/delete_user/$1';
$route['user/edit/(:any)'] = 'user/edit_user/$1';
$route['user/add'] = 'user/add_user';

$route['categories'] = 'category/index';
$route['categories/page/(:num)'] = 'category/index/$1';
$route['categories/page'] = 'category/index';
$route['category/add'] = 'category/add_category';
$route['category/delete/(:any)'] = 'category/delete_category/$1';
$route['category/edit/(:any)'] = 'category/edit_category/$1';

$route['providers'] = 'provider/index';
$route['providers/page/(:num)'] = 'provider/index/$1';
$route['providers/page'] = 'provider/index';
$route['provider/add'] = 'provider/add_provider';
$route['provider/delete/(:any)'] = 'provider/delete_provider/$1';
$route['provider/edit/(:any)'] = 'provider/edit_provider/$1';

$route['models'] = 'model/index';
$route['models/page/(:num)'] = 'model/index/$1';
$route['models/page'] = 'model/index';
$route['model/add'] = 'model/add_model';
$route['model/delete/(:any)'] = 'brand/delete_model/$1';
$route['model/edit/(:any)'] = 'model/edit_model/$1';

$route['products'] = 'product/index';
$route['products/page/(:num)'] = 'product/index/$1';
$route['products/page'] = 'product/index';
$route['product/add'] = 'product/add_product';
$route['product/delete/(:any)'] = 'product/delete_product/$1';
$route['product/edit/(:any)'] = 'product/edit_product/$1';
