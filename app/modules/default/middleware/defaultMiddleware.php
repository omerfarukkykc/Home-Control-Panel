<?php 
class defaultMiddleware extends Middleware{
    public function blockedAction()
    {   
       $defaultMiddlewareModel = new defaultModel();
       if($defaultMiddlewareModel->blockedActionMiddleware(USER_IP)!=null){
            return true;
       }else{
            return false;
       }
    }
}