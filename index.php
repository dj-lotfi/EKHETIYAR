<?php



define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(__FILE__));

// load configuration and helper functions

require_once(ROOT . DS .'config' . DS . 'config.php');
require_once(ROOT . DS .'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

//Autoload classes
spl_autoload_register(function($className){
//Cette fonction va automatiquement inclure une classe si elle est utilisée ,peu importe ou elle se trouve
//no need to require classes before using them
    if(file_exists(ROOT . DS . 'core' . DS . $className . '.php')){
        require_once(ROOT . DS . 'core' . DS . $className . '.php');
    } elseif(file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')){
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
    } elseif(file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')){
        require_once(file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php'));
    }
});


session_start();


$url = isset($_SERVER['PATH_INFO']) ? explode('/',ltrim($_SERVER['PATH_INFO'],'/')) : [];

Router::route($url);