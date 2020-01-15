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

//for default controller
$route['default_controller'] = 'home';

//for forgot password
$route['forgot_password'] = 'forgotpassword';
$route['password_reset_link'] = 'forgotpassword/send_link';
$route['reset_password'] = 'forgotpassword/resetpwd';
$route['reset_your_password'] = 'forgotpassword/resetpass_control';

//for signup functionality
$route['create_user'] = 'signup';
$route['login'] = 'authenticate';

//for pagination
$route['user_stories/(:num)'] = 'get/loadRecord/$1';

//for after login
$route['myaccount'] = 'myaccount';
$route['myprofile'] = 'myaccount/myprofile';

//for friend filter
$route['getfriendlist'] = 'get/getfriendlist';

//for upload story
$route['new_story'] = 'insert/upload_story';

//for updating user images
$route['update_profile_image'] = 'insert/update_profile';

//for settings 
$route['user_settings'] = 'settings';
$route['profile_update'] = 'settings/profile_update';

$route['update_like_counts'] = 'insert/update_like_counts';

//for logout
$route['logout'] = 'get/logout';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
