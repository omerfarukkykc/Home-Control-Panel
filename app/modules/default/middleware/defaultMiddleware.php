<?php 
class defaultMiddleware extends Middleware{
    public function blockedAction()
    {   
       $defaultMiddlewareModel = new defaultModel();
       if($defaultMiddlewareModel->blockedAction(USER_IP)!=null){
            return true;
       }else{
            print_r($defaultMiddlewareModel->blockedAction(USER_IP));
            return false;
       }
    }
}