<?php   
class clientController extends Controller implements FrontController{
    
    public function loginAction()
    {   $clientModel = new clientModel();
        if(isset($_SESSION['user'])){
            Controller::redirect("/client/dashboard");

        }
        $clientModel->loginModel();
        $param = null;
        $this->RenderLayout("login","client","login",$param);
    }
    public function logoutAction()
    {
        session_destroy();
        Controller::redirect("/");
    }
    public function dashboardAction($param = null)
    {   
        $clientModel = new clientModel();
        $param['general']= $clientModel->dashboardModel();
        $this->RenderLayout("client","client","dashboard",$param);
    }
    public function centigradeAction(){
        $clientModel = new clientModel();
        echo $clientModel->centigradeModel();
    }



    public function statisticsAction()
    {

        $param = null;
        $this->RenderLayout("client","client","statistics",$param);
    }
    public function notificationAction()
    {

        $param = null;
        $this->RenderLayout("client","client","notification",$param);
    }
    public function roomAction()
    {

        $param = null;
        $this->RenderLayout("client","client","room",$param);
    }
    public function roomsAction()
    {

        $param = null;
        $this->RenderLayout("client","client","rooms",$param);
    }
    
    

}