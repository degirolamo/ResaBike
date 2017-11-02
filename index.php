<?php
namespace ResaBike;

use ResaBike\Library\Router;

session_start();

//Define constant
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)));
define('APPPATH', realpath(ROOT.DS.'app'));
define('LIBPATH', realpath(ROOT.DS.'library'));
define('ASSETSPATH', realpath(ROOT.DS.'assets'));

define('DEBUG_LEVEL', 2);

setlocale (LC_ALL, 'fr_CH.utf8','fra');

require LIBPATH.DS.'autoload.php';
require LIBPATH.DS.'function.php';

$_SESSION['lang'] = (isset($_SESSION['lang'])) ? $_SESSION['lang'] : 'fr';

//Load Router
$rooter = new Router();
$rooter->SetErrorReporting();

//Run
$rooter->CallHook();