<?php 
class adminController extends Controller implements FrontController{
    
    public function dashboardAction($param = null)
    {   $adminModel = new adminModel();
        $data = $adminModel->dashboardModel();
        $this->RenderLayout("admin","admin","dashboard",$data);
    }
    public function loginAction()
    {   
        
        $adminModel = new adminModel();
        $adminModel->loginModel();
        $this->RenderLayout("login","admin","login");
    
    }
    public function logoutAction()
    {   
        
        session_destroy();
        Controller::redirect("/");

    }
    public function usersAction()
    {   
        
        $adminModel = new adminModel();
        $users = $adminModel->usersModel();
        $this->RenderLayout("admin","admin","users",$users);

    }
    public function adduserAction()
    {   

        if(isset($_POST['username']))
        {
            

            $adminModel = new adminModel();
            $data = $adminModel->adduserModel();
            if(isset($data['check'])){
               echo json_encode($data);
            }else{
                echo $data;
            }
        
        }else{
            $this->RenderLayout("admin","admin","adduser");
        }

    }
    public function edituserAction($id = null)
    {   
        
        $adminModel = new adminModel();
        if($id==null){
            Controller::redirect("/admin/users");
        }else{
            $user = $adminModel->edituserModel($id);
            $this->RenderLayout("admin","admin","edituser",$user);
        }

    }
    public function saveuserAction()
    {

        $adminModel = new adminModel();
        $adminModel->saveuserModel();

    }

    public function messagesAction(){
        $adminModel = new adminModel();
        $this->RenderLayout("admin","admin","messages",$adminModel->messagesModel());
    }
    public function readAction(){
        $adminModel = new adminModel();
        return $adminModel->readModel();
    }
    // Room Operation
    public function getroomAction()
    {

        $adminModel = new adminModel();
        echo  $adminModel->getroomsModel();

    }
    public function editroomAction($id = null)
    {  
        if($id==null){
            Controller::redirect("/admin/users");
        }else{
            $adminModel = new adminModel();
            $data = $adminModel-> getRoomDataModel($id);
            $this->RenderLayout("admin","admin","editroom",$data);
        }
    }
    public function addroomAction()
    {

        $adminModel = new adminModel();
        $adminModel->addroomModel();
        
    }
    public function deleteroomAction()
    {

        $adminModel = new adminModel();
        $adminModel->deleteroomModel();
    
    }
    public function deleteuserAction(){
        $adminModel = new adminModel();
        $adminModel->deleteuserModel();
    }
    // in-Room Operation
    public function getdevicesAction(){
        $adminModel = new adminModel();
        echo $adminModel->getDevicesModel();
    }
    public function adddeviceAction(){
        $adminModel = new adminModel();
        echo $adminModel->addDeviceModel();
    }
    public function getsocketsAction(){
        $adminModel = new adminModel();
        echo $adminModel->getSocketsModel();
    }
    public function addsocketAction(){
        $adminModel = new adminModel();
        echo $adminModel->addSocketModel();
    }
    public function deletesocketAction(){
        $adminModel = new adminModel();
        $adminModel->deleteSocketModel();
    }
    public function deletedeviceAction(){
        $adminModel = new adminModel();
        $adminModel->deleteDeviceModel();
    }
    public function saveroomAction(){
        $adminModel = new adminModel();
        $adminModel->saveRoomModel();
    }
    
} 