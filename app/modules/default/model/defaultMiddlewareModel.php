<?php

class defaultModel extends Model {
    public function blockedAction($ip_address)
    {
        $this->db->where("ip_address",$ip_address);
        return !is_null($this->db->getOne("log_blocked_ip_addresses"));
        
    }
}


?>