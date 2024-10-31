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
$route['default_controller'] = 'authentication';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/**
 * Coupon Code Url Set
 */
$route['admin/coupon'] = 'Coupon';
/**
 * Subscription Code Url Set
 */
$route['admin/subscription'] = 'Subscription';
$route['subscription-plan'] = 'Authentication/subscription_plan';
$route['admin/download'] = 'import_export_template/download';
$route['admin/theme-setting'] = 'admin/theme_setting_option';   
$route['admin/google-analytics'] = 'theme_setting/google_analytics_script'; 
$route['admin/smtp-setting'] = 'theme_setting/smtp_settings'; 
$route['admin/payment-setting'] = 'theme_setting/payment_setting'; 
$route['admin/profile'] = 'admin/admin_profile';  
$route['admin/api-setting'] = 'admin/api_setting';  
$route['admin/rest-api'] = 'admin/restApi';  
$route['admin/template-importer'] = 'admin/templateImporter';  
$route['embed/template/(:any)'] = 'Images_loads_ajax/embed_code_template_images/$1';     
$route['pay-with-paypal/(:any)'] = 'Paypal/index/$1';
$route['pay-with-stripe/(:any)'] = 'Stripes/index/$1';      
$route['pay-with-free/(:any)'] = 'Stripes/freePlan/$1';      
$route['subsription'] = 'Stripes/create_subscription_plan';      
$route['user-template'] = 'Restapi/userGetTemplate';      
$route['admin/language-setting'] = 'admin/languageSetting';      