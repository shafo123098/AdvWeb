<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['login'] = 'users/login';
$route['logout'] = 'users/logout';

$route['entity/newStudent'] = 'entities/addStudent';
$route['entity/newDriver'] = 'entities/addDriver';
$route['entity/newBus'] = 'entities/addBus';
$route['entity/newBusRoute'] = 'entities/addBusRoute';

$route['entity/updateStudent'] = 'entities/updateStudent';

$route['entities/index'] = 'entities/index';
$route['entity'] = 'entities/index';
$route['users'] = 'users/getUsers';
$route['user'] = 'users/getUserByName';
$route['entity/buses'] = 'entities/showBuses';
$route['entity/routes'] = 'entities/showRoutes';
$route['entity/drivers'] = 'entities/showDrivers';
$route['entity/faculties'] = 'entities/showFaculties';
$route['entity/busesRoutes'] = 'entities/showRoutesPlan';

$route['(:any)'] = 'pages/view/$1';
$route['entity/(:any)'] = 'entities/viewStudent/$1';
$route['entity/bus/(:any)'] = 'entities/viewBus/$1';
$route['entity/driver/(:any)'] = 'entities/viewDriver/$1';
$route['entity/route/(:any)'] = 'entities/viewRoute/$1';
$route['entity/faculty/(:any)'] = 'entities/viewFaculty/$1';
//$route['entity/routePlan'] = 'entities/viewRoutePlan';

$route['404_override'] = 'Custom404';
$route['default_controller'] = 'pages/view';

$route['translate_uri_dashes'] = FALSE;
