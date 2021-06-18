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
        //3 id li kullanıcı test kullanıcısıdır 
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['rol_id']==3){
                $this->createTestData(3);
            }
        }   
        
    }
    public function dashboardModel(){

        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->data['general'] = $this->db->getOne("user_general");
        return $this->data;
    }
    public function notificationModel(){
        $this->createTestData(3);
        return $this->data;
    }
    public function statisticsModel(){
        //Güç tüketim grafiği
        $this->db->join("rooms","users.ID=rooms.user_id");
        $this->db->join("room_sockets","rooms.ID=room_sockets.room_id","LEFT");
        $this->db->join("socket_powers","room_sockets.ID=socket_powers.socket_id","LEFT");
        $this->db->where("YEAR(date)",date("Y"));
        $this->db->where("MONTH(date)",date("m"));
        $this->db->where("DAY(date)",date("d"));
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->data['socket_power'] = $this->db->get("users");
        foreach($this->data['socket_power'] as $value){
            $time = explode(":",$value['time']);
            if(!isset($this->data['sum_socket_data'][$time[0]])){
                $this->data['sum_socket_data'][ceil($time[0])] = null;
            }
            $this->data['sum_socket_data'][ceil($time[0])] += $value['power'];
        }
        if(!isset($this->data['sum_socket_data'])){
            $this->data['sum_socket_data']=array();
        }
        unset($this->data['socket_power']);
        ksort($this->data['sum_socket_data']);
        //Odaların tüketim oran grafiği
        foreach($this->data['sidebar']['rooms'] as $key => $value){
            $this->data['rooms'][$key] =  $value['roomName'];
            $roomData = $this->roomModel($value['ID']);
            
            $this->data['roomsPower'][$key] = array_sum($roomData['sockets_data']) + 0.1;
            unset($this->data['sockets_data']);
        }
        unset($this->data['room_info']);
        $this->data['sumWatt'] = array_sum($this->data['roomsPower']);
        //Aylık fatura grafiği
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->db->where("MONTH(date)",date("m")-1);
        $bills = $this->db->getOne("bills");
        if($bills == null){
            //geçen ayın faturası heasaplanır ve eklenir. 
            
            $this->db->join("rooms","users.ID=rooms.user_id");
            $this->db->join("room_sockets","rooms.ID=room_sockets.room_id","LEFT");
            $this->db->join("socket_powers","room_sockets.ID=socket_powers.socket_id","LEFT");
            $this->db->where("YEAR(date)",date("Y"));
            $this->db->where("MONTH(date)",date("m")-1);
            $this->db->where("user_id",$_SESSION['user']['ID']);
            $this->data['socket_power'] = $this->db->get("users");
            $newbill['kW'] = 0;
            foreach($this->data['socket_power'] as $value){
                $newbill['kW'] += $value['power'];
            }
            $newbill['kW']/=1000; 
            unset($this->data['socket_power']);
            $newbill['bill_amount'] = $newbill['kW']*0.3967;
            $newbill['user_id'] = $_SESSION['user']['ID'];
            $newbill['date'] =  date("Y-m-d H:i:s",strtotime('-1 month'));
            $this->db->insert("bills",$newbill);
        }
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->db->where("YEAR(date)",date("Y"));
        $bills = $this->db->get("bills");
        if($bills != null){
            for($i=1;$i<13;$i++){
                $this->data['monthly_bills'][$i]=0;
                $this->data['monthly_kW'][$i] = 0;
            }
            foreach($bills as $key => $bill){
                $this->data['monthly_bills'][ceil(date("m",strtotime($bill['date'])))] = $bill['bill_amount'];
                $this->data['monthly_kW'][ceil(date("m",strtotime($bill['date'])))] = $bill['kW'];
            }
            
        }else{
            $this->data['monthly_bills'] = null ;
            $this->data['monthly_kW'] = null;
        }
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
    public function roomModel($room_id){

        if(!isset($room_id)){
            return null;
        }
        $this->db->where("ID",$room_id);
        $this->data['room_info'] = $this->db->getOne("rooms");
        $this->db->where("room_id",$room_id);
        $this->db->join("room_sockets","room_sockets.room_id=rooms.ID","LEFT");
        $this->db->join("socket_powers","room_sockets.ID=socket_powers.socket_id","LEFT");
        $this->db->where("YEAR(date)",date("Y"));
        $this->db->where("MONTH(date)",date("m"));
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
            $this->data['sockets_data']=array();
        }
        unset($this->data['room_powers']);
        ksort($this->data['sockets_data']);
        return $this->data;
    }
    public function roomcModelMiddleware($id)
    {
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->db->where("ID",$id);
        return ($this->db->getOne("rooms")!=null)?  true :  false;
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
    public function roomcModel($id)
    {
        $this->db->where("user_id",$_SESSION['user']['ID']);
        $this->db->where("ID",$id);
        return ($this->db->getOne("rooms")!=null)?  true :  false;
    }
    public function createTestData($user_id){
        $data['user_id'] = $user_id;
        $this->db->join("room_sockets","room_sockets.room_id=rooms.ID");
        $this->db->where("user_id", $user_id);
        $data = $this->db->get("rooms");
        foreach($data as $value){
           for($i = 0; $i<8;$i++){
            $newPowData['socket_id'] = $value['ID'];
            $newPowData['power'] = rand(500,1000);
            $newPowData['time'] = date("H:i:s",strtotime("0{$i}:00:00"));
            $this->db->insert("socket_powers",$newPowData);
           }
        }
    }
}