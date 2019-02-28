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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['register'] = 'login/register';
$route['logout'] = 'login/process_logout';
$route['login/google_user_authentication'] = 'login/google_user_authentication';
$route['my-account'] = 'account/index';
$route['(:any)/(:any)/(:any)'] = 'product/index/$1/$2/$3';
$route['product/ajax_load_providers'] = 'product/ajax_load_providers';
$route['product/ajax_load_login'] = 'product/ajax_load_login';
$route['product/ajax_load_registration'] = 'product/ajax_load_registration';
$route['account-summary/edit'] = 'account/index';
$route['account-summary/summary'] = 'account/order_history';
$route['account-summary/ajax-summary/(:any)/(:any)'] = 'account/ajax_order_history/$1/$2';
$route['account-summary/address'] = 'account/address';
$route['order-details/(:any)'] = 'order/order_details/$1';
$route['payment-carrier'] = 'order/payment_carrier';
$route['thankyou'] = 'order/order_thanks';
$route['track-order'] = 'order/track_order';