<?php 
class clientMiddleware extends Middleware{
    public function dashboardAction()
    {   
        return true;
    }
    public function roomAction($id)
    {   
        $model = new clientModel();
        return $model->roomcModelMiddleware($id);
    }
}