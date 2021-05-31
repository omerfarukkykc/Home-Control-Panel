<?php

class Model {
    public $db;
    public function __construct()
    {
        $this->db = new MysqliDb (HOST, USER, PASS, DBNAME);
    }
    public function __destruct()
    {
        $this->db->disconnectAll();   
    }
    public function cryptedPassword($password){
        $saltpassword="";
        for($i =0;$i<strlen($password);$i++){
            if(ord($password[$i])<105){
                $saltpassword = $saltpassword .chr(ord($password[$i])+20) . ord($password[$i]) . "h";
            }else if(ord($password[$i])<110){
                $saltpassword = $saltpassword  . ord($password[$i]) . "i". chr(ord($password[$i])-20);
            }else if(ord($password[$i])<120){
                $saltpassword = $saltpassword   . "t". chr(ord($password[$i])-20). ord($password[$i]);
            }else{
                $saltpassword = "," . ord($password[$i]) . $saltpassword . chr(ord($password[$i])-20);
            }
        }
        $crpytopassword = md5(sha1($saltpassword));
        return $crpytopassword;
    }
}

?>