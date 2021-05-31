<?php 
class adminModel extends Model{
    public function dashboardModel(){
        for($i=0;$i<12;$i++){
            $this->db->where("MONTH(creationDate)",$i);
            $data['userCountMonthly'][$i] = count($this->db->get("users"));
        }
        $data['userCount'] = count($this->db->get("users")); 
        return $data;
    }
    public function loginModel()
    {

        if(!isset($_POST['username'])||!isset($_POST['password'])){
            return null;
        }
        $this->db->where("email",$_POST['username']);
        $this->db->orwhere("username",$_POST['username']);
        $this->db->where("password",$this->cryptedPassword($_POST['password']));
        $this->db->join("user_rols","users.ID = user_rols.user_id");
        $user = $this->db->getOne("users");
        if($user!=null){
            if($user['rol_id']==1){
                $_SESSION['admin'] = $user;
                $_SESSION['user'] = $user;
                Controller::redirect("/admin/dashboard");
            }else if($user['rol_id']==2){
                $_SESSION['user'] = $user;
            }
        }else{
            print_r($user);
        }

    }
    public function usersModel()
    {

        return $this->db->get('users');

    }
    public function adduserModel()
    {
        if(!isset($_POST['email'])||!isset($_POST['password'])||!isset($_POST['username'])){
            return "null";
        }

        $this->db->where("email",$_POST['email']);
        if(null!=$this->db->getOne("users")){
            return "Bu mail zaten kayıtlı.";
        }

        $this->db->where("username",$_POST['username']);
        if(null!=$this->db->getOne("users")){
            return "Bu kullanıcı adı zaten kayıtlı.";
        }

        $this->db->where("phone",$_POST['phone']);
        if(null!=$this->db->getOne("users")){
            return "Bu telefon numarası zaten kayıtlı.";
        }

        if($_POST['password']!=$_POST['passwordChecker']){
            return "Şifreler eşleşmiyor";
        }
        if($_POST['email']!=$_POST['emailChecker']){
            return "Mail adresleri eşleşmiyor";
        }
        if(strlen($_POST['password'])<6){
            return "Şifre 6 karakterden az olamaz";
        }
        unset($_POST['passwordChecker']);
        unset($_POST['emailChecker']);

        //Kullanıcı users tablosuna eklenir
        $_POST['password'] = $this->cryptedPassword($_POST['password']);
        $_POST['creationDate'] = date("Y-m-d H:i:s"); 
        $user_id = $this->db->insert("users",$_POST);

        //Kullanıcını rol tablosuna eklenir
        $user_rol = array();
        $user_rol['user_id'] = $user_id;
        $user_rol['rol_id'] = 2;
        $this->db->insert("user_rols",$user_rol);

        //Kullanıcının genel ayarları default ayarlar olarak atanır
        $user_general = array();
        $user_general['user_id'] = $user_id; 
        $this->db->insert("user_general",$user_general);


        $data['check'] = true;
        $data['id'] = $user_id;
        return $data;


    }
    public function edituserModel($id)
    {

        $this->db->where("ID",$id);
        return $this->db->getOne('users');

    }
    public function saveuserModel()
    {

        if(!isset($_POST['id'])){
            return null;
        }
        $this->db->where("ID",$_POST['id']);
        array_shift($_POST);
        unset($_POST['emailChecker']);
        $this->db->update("users",$_POST);

    }
    public function deleteuserModel(){
        if(!isset($_POST['user_id'])){
            return null;
        }
        $this->db->where("user_id",$_POST['user_id']);
        $this->db->delete("user_general");
        $this->db->where("user_id",$_POST['user_id']);
        $this->db->delete("user_rols");
        $this->db->where("ID",$_POST['user_id']);
        $this->db->delete("users");
        $this->db->where("user_id",$_POST['user_id']);
        $room_id = $this->db->delete("rooms");
        // delete device and sockets with room id
        echo $room_id; 
        
    }
    // Room operation
    public function getroomsModel()
    {

        if(!isset($_POST['id'])){
            return null;
        }
        $this->db->where("user_id",$_POST['id']);
        $rooms = $this->db->get("rooms");
        return json_encode($rooms);

    }
    public function addroomModel()
    {

        if(!isset($_POST['roomname'])||!isset($_POST['id']))
        {
            return null;
        }
        $data['user_id'] = $_POST['id'];
        $data['roomName'] = $_POST['roomname'];
        $data['lampStatus'] = 0;
        $data['room_tem'] = 37;
        $data['room_hum'] = 45;
        $this->db->insert("rooms",$data);
        
    }
    public function deleteroomModel()
    {

        if(!isset($_POST['room_id'])){
            return null;
        }
        $this->db->where("ID",$_POST['room_id']);
        $this->db->delete("rooms");

    }
    public function getRoomDataModel($id)
    {
        $this->db->where("ID",$id);
        return $this->db->getOne("rooms");
    }

    
    // in-room operations
    public function getDevicesModel(){
        if(!isset($_POST['room_id'])){
            return null;
        }
        $this->db->where("room_id",$_POST['room_id']);
        $devices = $this->db->get("room_devices");

        return json_encode($devices);
    }
    public function addDeviceModel(){
        if(!isset($_POST['room_id'])||!isset($_POST['device_name'])||""==$_POST['device_name']){
            return "fail";
        }
        $this->db->insert("room_devices",$_POST);
    }
    public function deleteDeviceModel(){
        if(!isset($_POST['device_id'])){
            return null;
        }
        $this->db->where("ID",$_POST['device_id']);
        $this->db->delete("room_devices");
    }
    public function getSocketsModel(){
        if(!isset($_POST['room_id'])){
            return null;
        }
        $this->db->where("room_id",$_POST['room_id']);
        $sockets = $this->db->get("room_sockets");
        return json_encode($sockets);
    }
    public function addSocketModel(){
        if(!isset($_POST['room_id'])||!isset($_POST['socket_name'])||""==$_POST['socket_name']){
            return "fail";
        }
        $this->db->insert("room_sockets",$_POST);
    }
    public function deleteSocketModel(){
        if(!isset($_POST['socket_id'])){
            return null;
        }
        $this->db->where("ID",$_POST['socket_id']);
        $this->db->delete("room_sockets");
    }
    public function saveRoomModel(){
        if(!isset($_POST['room_id'])||!isset($_POST['roomName']))
        {
            
            return null;
        }
        $this->db->where("ID",$_POST['room_id']);
        $this->db->update("rooms",$_POST);
        
    }
    
}