<?php

class defaultController extends Controller implements FrontController {
    public function dashboardAction($param = null)
    {
        $this->RenderLayout("default","default", "dashboard");
    }
    
    public function blockedAction(){
        $defaultModel = new defaultModel();
        $data['ip'] = USER_IP;
        $data['msg'] = $defaultModel->blockedAction(USER_IP)['msg'];
        $this->RenderLayout("login","default","blocked",$data);
    }
    public function contactusAction(){
        $this->RenderLayout("default","default","contuctus");
    }
    public function sendmessageAction(){
        
        $defaultModel = new defaultModel();
        $defaultModel->sendmessageAction();
        $this->RenderLayout("default","default","sucmessage");

    }
}   