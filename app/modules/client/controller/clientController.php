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
        $param = $clientModel->dashboardModel();
        $this->RenderLayout("client","client","dashboard",$param);
    }
    public function centigradeAction(){
        $clientModel = new clientModel();
        return $clientModel->centigradeModel();
    }
    public function statisticsAction()
    {

        $clientModel = new clientModel();
        $param = $clientModel->statisticsModel();
        $this->RenderLayout("client","client","statistics",$param);
    }
    public function notificationAction()
    {

        $clientModel = new clientModel();
        $param = $clientModel->notificationModel();
        $this->RenderLayout("client","client","notification",$param);
    }
    public function roomAction()
    {
        $clientModel = new clientModel();
        $param = $clientModel->roomModel();
        $this->RenderLayout("client","client","room",$param);
    }
    public function socketpowerAction()
    {
        $clientModel = new clientModel();
        $param = $clientModel->socketpowerModel();
        return $param;
    }
    public function lightpowerAction(){
        $clientModel = new clientModel();
        $param = $clientModel->lightpowerModel();
        return $param;
    }
    public function modselectAction(){
        $clientModel = new clientModel();
        return $clientModel->modSelectModel();
    }
    public function getsocketsAction(){
        $adminModel = new adminModel();
        echo $adminModel->getSocketsModel();
    }
    public function getdevicesAction(){
        $adminModel = new adminModel();
        echo $adminModel->getDevicesModel();
    }
    public function roomsAction()
    {
        $clientModel = new clientModel();
        $param = $clientModel->roomModel();
        $this->RenderLayout("client","client","rooms",$param);
    }
    public function alarmpowerAction(){
        $clientModel = new clientModel();
        return $clientModel->alarmPowerModel();
    }
    
    
    
    

}