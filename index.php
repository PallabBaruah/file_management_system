<?php
define('ENVIRONMENT', 'development');

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}
$page_title='';
require_once("./templates/WebSiteTemplate.class.php");
$template = new PageTemplate();
$template->GeneratePageHeader($page_title,"ST HomePage");
include_once("./classes/database.class.php");
include_once("./controller/controller.php");
$controller = new Controller();  
$controller->invoke(); 
$template->GeneratePageFooter(); 
?>

