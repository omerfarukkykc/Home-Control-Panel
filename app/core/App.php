<?php

class App {

    protected static $routes = [];
    protected static $config;

    protected $activePath;
    protected $activeMethod;
    protected $notFound;
    protected $auth;

    public function __construct($activePath, $activeMethod, $config)
    {

        
        $this->activePath = $activePath;

        $this->activeMethod = $activeMethod;
        self::$config = $config;
        $this->auth = self::$config['authentication'];

        $this->notFound = function ($data){
            http_response_code(404);
            Controller::redirect("/404");
        };

    }

    public static function get($path, $auth = false,  $callback = null)
    {
        self::$routes[] = ['GET', $path, $auth, $callback];
        
    }
    public static function post($path, $auth = false,  $callback = null)
    {
        self::$routes[] = ['POST', $path, $auth, $callback];
    }

    public function run()
    {
        foreach(self::$routes as $route)
        {

            list($method, $path, $auth, $params) = $route;
            $methodCheck = $this->activeMethod == $method;
            $pathCheck   = preg_match("~^{$path}$~", $this->activePath, $params);
            if($methodCheck && $pathCheck)
            {
                $url = explode("/", $path);
                if(count($url) == 2)
                {
                    $module     = "default";
                    $controller = "defaultController";
                    $action     = "dashboardAction";
                }
                else
                {   
                    if($auth == true && isset($_SESSION[$this->auth['auth_files'][$url[1]]]) || $auth == false)
                    {
                        $module     = $url[1];
                        $controller = $url[1]."Controller";
                        $action     = $url[2]."Action";
                    }
                    else
                    {
                        Controller::redirect($this->auth['auth_urls'][$url[1]]);
                        exit;
                    }
                    
                }

                if(file_exists($file = APP_DIR."/modules/{$module}/controller/{$controller}.php"))
                {
                    require_once $file;

                    if(class_exists($controller))
                    {
                        $class = new $controller;

                        if(method_exists($class, $action))
                        {
                            array_shift($params);

                            return call_user_func_array([$class, $action], array_values($params));
                        }
                        else
                        {
                            echo "Method Mevcut Değil <br>".$action."<br>";
                        }

                    }
                    else
                    {
                        echo "Sınıf Mevcut Değil";
                    }
                }
                else{
                     echo "Controller Mevcut Değil";
                }

            }
            
        }
        return call_user_func_array($this->notFound,array([$pathCheck,$this->activePath,$params]));
        
    }
    



}



?>