<?php
session_start();
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('LIEN', substr($_SERVER['REQUEST_URI'], strlen(WEBROOT)));
require(ROOT.'configurations.php');
require(ROOT.'core/modules.php');
require(ROOT.'bdd.php');
require(ROOT.'core/base.php');
require(ROOT.'core/controller.php');
$param = explode('/', LIEN);

$controller = isset($param[0]) && $param[0] != "" ? $param[0] : 'news';
$action = isset($param[1]) && $param[1] != "" ? $param[1] : 'index';

$url_controller = ROOT.'controllers/'.$controller.'.php';
if (!file_exists($url_controller)){
    exit("Directory access is forbidden.");
}
require($url_controller);
$controller = new $controller();
if (method_exists($controller, $action)){
    unset($param[0]);
    unset($param[1]);
    call_user_func_array(array($controller,$action), array(ResetArray($param)));
}else{
    exit("Directory access is forbidden.");
}
?>
