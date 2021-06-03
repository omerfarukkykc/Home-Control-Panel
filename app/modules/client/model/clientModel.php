<?php

use function PHPSTORM_META\type;

class clientModel extends Model {
    
    public function loginModel(){
        if(!isset($_POST['username'])||!isset($_POST['password'])){
            return null;
        }
        $this->db->where("email",$_POST['username']);
        $this->db->orwhere("username",$_POST['username']);
        $this->db->where("password",$this->cryptedPassword($_POST['password']));
        $user = $this->db->getOne("users");
        if($user!=null){
            $_SESSION['user'] = $user;
            Controller::redirect("/client/dashboard");
        }
        
    }
    public function dashboardModel(){
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->data['general'] = $this->db->getOne("user_general");
        return $this->data;
    }
    public function notificationModel(){
        
        return $this->data;
    }
    public function statisticsModel(){
        $this->db->join("rooms","users.ID=rooms.user_id");
        $this->db->join("room_sockets","rooms.ID=room_sockets.room_id","LEFT");
        $this->db->join("socket_powers","room_sockets.ID=socket_powers.socket_id","LEFT");
        $this->db->where("DAY(date)",date("d"));
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->data['socket_power'] = $this->db->get("users");
        foreach($this->data['socket_power'] as $value){
            $time = explode(":",$value['time']);
            if(!isset($this->data['socket_data'][$time[0]])){
                $this->data['socket_data'][ceil($time[0])] = null;
            }
            $this->data['socket_data'][ceil($time[0])] += $value['power'];
        }
        if(!isset($this->data['socket_data'])){
            for($i=0;$i<24;$i++){
                $this->data['socket_data'][$i]=0;
            }
        }
        unset($this->data['socket_power']);
        ksort($this->data['socket_data']);
        
        return $this->data;
    }
    public function centigradeModel(){
        if(!isset($_POST['key'])||!isset($_POST['value'])){
            return null;
        }
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $user_general = $this->db->getOne("user_general");
        if($_POST['key']=="water"){
            $this->db->where("user_id",$_SESSION['user']['ID']);
            $data['set_water_tem']=$user_general['set_water_tem']+$_POST['value'];
            $this->db->update("user_general",$data);
            return $data['set_water_tem']."°C";
        }else if($_POST['key']=="heater"){
            $this->db->where("user_id",$_SESSION['user']['ID']);
            $data['set_house_tem']=$user_general['set_house_tem']+=$_POST['value'];
            $this->db->update("user_general", $data);
            return $data['set_house_tem']."°C";
        }else{
            return null;
        }
    }
    public function roomModel(){
        if(!isset($_POST['room_id'])){
            return null;
        }
        $this->db->where("ID",$_POST['room_id']);
        //$this->db->join("room_sockets","room_sockets.room_id=rooms.ID","LEFT");
        $this->data['room_info'] = $this->db->getOne("rooms");
        $this->db->where("room_id",$_POST['room_id']);
        $this->db->join("room_sockets","room_sockets.room_id=rooms.ID","LEFT");
        $this->db->join("socket_powers","room_sockets.ID=socket_powers.socket_id","LEFT");
        $this->db->where("DAY(date)",date("d"));
        $this->data['room_powers'] = $this->db->get("rooms");
        foreach($this->data['room_powers'] as $value){
            $time = explode(":",$value['time']);
            
            if(!isset($this->data['room_powers'][$time[0]])){
                $this->data['sockets_data'][ceil($time[0])] = null;
            }
            $this->data['sockets_data'][ceil($time[0])] += $value['power'];
        }
        if(!isset($this->data['sockets_data'])){
            for($i=0;$i<24;$i++){
                $this->data['sockets_data'][$i]=0;
            }
        }
        unset($this->data['room_powers']);
        ksort($this->data['sockets_data']);
        return $this->data;
    }
    public function socketpowerModel(){
        if(!isset($_POST['socket_id'])){
            return null;
        }
        $this->db->where("ID",$_POST['socket_id']);
        $stat = $this->db->getOne("room_sockets");
        ($stat['status']==0) ? $stat['status']=1 :$stat['status']=0;
        $this->db->where("ID",$_POST['socket_id']);
        $this->db->update("room_sockets",$stat);
        
        return  $stat['status'];
    }
    public function lightpowerModel(){
        if(!isset($_POST['room_id'])){
            return null;
        }
        $this->db->where("ID",$_POST['room_id']);
        $stat = $this->db->getOne("rooms");
        ($stat['lampStatus']==0) ? $stat['lampStatus']=1 :$stat['lampStatus']=0;
        $this->db->where("ID",$_POST['room_id']);
        $this->db->update("rooms",$stat);
        return  $stat['lampStatus'];
    }
    public function modSelectModel(){
        if(!isset($_POST['general_id'])||!isset($_POST['mod'])){
            return null;
        }
        
        $this->db->where("ID",$_POST['mod']);
        $data = $this->db->getOne("mods");
        unset($data['mod_name']);
        unset($data['ID']);
        $data['mod'] = $_POST['mod'];
        $this->db->where("ID",$_POST['general_id']);
        $this->db->update("user_general",$data);
        return json_encode($data);
    }
    public function alarmPowerModel(){
        if(!isset($_POST['user_id'])){
            return null;
        }
        $this->db->where("user_id",$_POST['user_id']);
        $stat = $this->db->getOne("user_general");
        ($stat['alarm']==0) ? $stat['alarm']=1 :$stat['alarm']=0;
        $this->db->where("user_id",$_POST['user_id']);
        $this->db->update("user_general",$stat);
        return $stat['alarm'];
    }
    
}