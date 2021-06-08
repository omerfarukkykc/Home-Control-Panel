<?php

class defaultModel extends Model {
    public function blockedActionMiddleware($ip_address)
    {   
        $this->db->where("ip_address",$ip_address);
        $data =$this->db->getOne("log_blocked_ip_addresses");    
        if($data!=null){
            $this->db->where("ID",$data['ban_reson_id']);
            $data['msg'] = $this->db->getOne("log_ban_resons")['msg'];
        }
        return $data;
    }  
    public function blockedAction($ip_address){
        $this->db->where("ip_address",$ip_address);
        $data =$this->db->getOne("log_blocked_ip_addresses");    
        if($data!=null){
            $this->db->where("ID",$data['ban_reson_id']);
            $data['msg'] = $this->db->getOne("log_ban_resons")['msg'];
        }
        return $data;
    }
    public function setmessageAction(){
        if
        (
            !isset($_POST['subject'])||
            !isset($_POST['name'])||
            !isset($_POST['phone'])||
            !isset($_POST['email'])||
            !isset($_POST['text'])
        ){
            return false;
        }
        $data['name'] = $_POST['name'];
        $data['phone'] = $_POST['phone'];
        $data['email'] = $_POST['email'];
        $data['subject'] = $_POST['subject'];
        $data['text'] = $_POST['text'];
        echo $this->db->insert("contact_messages",$data);
        return "Başarılı";
    }
}


