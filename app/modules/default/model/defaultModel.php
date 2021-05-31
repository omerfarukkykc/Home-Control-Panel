<?php

class defaultModel extends Model {
    public function blockedAction($ip_address)
    {   
        $this->db->where("ip_address",$ip_address);
        $data =$this->db->getOne("log_blocked_ip_addresses");    
        if($data!=null){
            $this->db->where("ID",$data['ban_reson_id']);
            $data['msg'] = $this->db->getOne("log_ban_resons")['msg'];
        }
        return $data;
    }  
}


