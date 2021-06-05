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
            {   array_shift($params);
                preg_match("~^{$path}$~", $path, $receivedParameters);
                array_shift($receivedParameters);
                if(isset($receivedParameters[0])){
                    $numberOfParameter = count(explode("/",$receivedParameters[0]));
                    
                    if(count(explode("/",$params[0]))!=$numberOfParameter){
                        continue;
                    }
                }
                if($route[3]!=null){
                    call_user_func($route[3]);
                    exit;
                }
                if($path=="/")
                {  
                    
                    $module     = "default";
                    $middleware = "defaultMiddleware";
                    $controller = "defaultController";
                    $action     = "dashboardAction";
                }
                else
                {   $url = explode("/", $path);
                    if($auth == true && isset($_SESSION[$this->auth['auth_files'][$url[1]]]) || $auth == false)
                    {
                        $module         = $url[1];
                        $middleware     = $url[1]."Middleware";
                        $controller     = $url[1]."Controller";
                        $action         = $url[2]."Action";

                    }
                    else
                    {
                        Controller::redirect($this->auth['auth_urls'][$url[1]]);
                        exit;
                    }
                    
                }
                if(Middleware::middlewareChecker($module,$middleware,$action,$params)){
                    Controller::startAction($module,$controller,$action,$params);
                    exit;
                }else{

                    echo "Ara yazılım onay vermedi";
                }

            }

        }

        return call_user_func_array($this->notFound,array([$pathCheck,$this->activePath,$params]));
    }
    



}



?>