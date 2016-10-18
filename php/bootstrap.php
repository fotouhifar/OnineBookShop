<?php

require_once("autoloader.php");
//require_once('html2pdf_v4.03/html2pdf.class.php');

//spl_autoload_register('__autoload');

// define URL constants 
if ($_SERVER['HTTP_HOST'] == 'localhost')
    define('PROJECT', '/OnlineBookShop/');
else
    define('PROJECT', '/');
define('PROJECT_URL', 'http://' . $_SERVER['HTTP_HOST'] . PROJECT);
define('IMAGES_URL', PROJECT_URL . 'public/images/');
define('MENUIMAGE', IMAGES_URL . 'menuitems/');
define('CSS_URL', PROJECT_URL . 'public/css/');
define('JS_URL', PROJECT_URL . 'public/js/');

define('CATEGORIESIMAGES', IMAGES_URL . 'categories/');
define('PRODUCTIMAGE', IMAGES_URL . 'Products/');

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('INCLUDES', ROOT . PROJECT . 'includes/');

$jquery = ($_SERVER['HTTP_HOST'] == 'localhost') ? JS_URL . "jquery-1.11.0.min.js" : "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js";

define('JQUERY', $jquery);
// get the url content after campingstore
$url = (isset($_GET['url'])) ? $_GET['url'] : "categories";

// take a url and subdivide the string by / and create an array
$controllerData = explode('/', $url);

// change the first letter to an uppercase
$controllerName = ucfirst($controllerData[0]);

// check that the controller class name in $controllerName exists as a php file. If not change the controller name to 'Categories'
$controllerName = (file_exists($_SERVER['DOCUMENT_ROOT'] . PROJECT . 'php/mvc/controller/' . $controllerName . ".php")) ? $controllerName : 'Categories';

// construct the class name to be instantiated
$control = "mvc\\controller\\" . $controllerName;

//instantiate the controller and pass it the array $controllerData
$controller = new $control($controllerData);

// excute the action method in controller
$controller->action();
?>