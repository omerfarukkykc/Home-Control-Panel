<?php

class Controller {
    public static function startAction($module,$controller,$action,$params){
        if(file_exists($file = APP_DIR."/modules/{$module}/controller/{$controller}.php"))
            {
                require_once $file;

                if(class_exists($controller))
                {
                    $class = new $controller;
                   
                    if(method_exists($class, $action))
                    {

                        
                        echo call_user_func_array([$class, $action], array_values($params));
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

    public function renderView($module, $action, $params = [])
    {
        return view::renderView($module, $action, $params);
    }

    public function RenderLayout($layout, $module, $action, $params = [])
    {
        return view::renderLayout($layout, $module, $action, $params);
    }

    public static function redirect($path)
    {
        header("Location:{$path}");
    }

}