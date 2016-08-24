<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['(:any)/list'] = 'pager/mylist/$1';
$route['(:any)/list/(:num)'] = 'pager/mylist/$1/$2';
$route['article/(:num)'] = 'pager/article/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
