<?php

define('APP_DIR', '../app');
define('CORE', APP_DIR.'/core');
define('CONFIG', APP_DIR.'/config');
define('USER_IP', $_SERVER["REMOTE_ADDR"]);
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DBNAME", "homecp");

//ini_set("display_errors", "Off");

global $config;

$config = array(
    "authentication" => array(
        "auth_urls" => array(
            "default" => "/default/login",
            "client"    => "/client/login",
            "admin"    => "/admin/login",
        ),
        "auth_files" => array(
            "default" => "user",
            "client" => "user",
            "admin"   => "admin",
        )
    ),
    "debug" => "yes"
);

require_once CORE."/Model.php";
require_once CORE."/Controller.php";
require_once CORE."/View.php";
require_once CORE."/App.php";
require_once CORE."/Middleware.php";
require_once CONFIG."/routing.php";
require_once APP_DIR."/vendor/autoload.php";


spl_autoload_register(function ($class_name){
    $module = explode("Model", $class_name);
    if(file_exists($file = APP_DIR."/modules/{$module[0]}/model/{$class_name}.php"))
        require_once $file;

    if(file_exists($file = CORE."/interface/{$class_name}.php"))
        require_once $file;
});


function fatal_handler()
{
    global $config;

    $error = error_get_last();
    if($error != NULL)
    {
        if($config['debug'] == "yes")
        {   
            echo"<pre>";
            var_dump($error);
            echo"</pre>";
        }
        elseif($config['debug'] == "no" && $error['type'] != 8192)
        {
            echo "<h3 style='text-align: center; color:red'>Sistemsel Hata!</h3>";
        }
    }
}

register_shutdown_function("fatal_handler");

?>