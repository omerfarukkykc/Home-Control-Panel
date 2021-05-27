<?php 
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
        return $this->db->getOne("user_general");
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
    
}