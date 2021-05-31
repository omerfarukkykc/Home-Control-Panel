<?php

class Middleware {
    public static function middlewareChecker($module,$middleware,$action){
        if($action!="blockedAction"){
            self::log_ip_checker();
        }
        
        self::log_ip_saver($module,$action);
        if(file_exists($file = APP_DIR."/modules/{$module}/middleware/{$middleware}.php"))
        {
            require_once $file;

            if(class_exists($middleware))
            {
                $class = new $middleware;

                if(method_exists($class, $action))
                {   
                    $result = call_user_func([$class, $action]);
                    if(gettype($result) == "boolean"){

                        return $result;
                        
                    }else{
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else
            {
                return true;
            }
        }
        else{
               return true;
        }
    }
    public static function log_ip_checker(){
        $model = new Model();
        $model->db->where("ip_address",USER_IP);
        $data = $model->db->getOne("log_blocked_ip_addresses");
        if($data!=null){
            if($data['ban_reson']!=null){
                Controller::redirect("/default/blocked/{$data['ip_address']}/{$data['ban_reson']}");
                exit;
            }else{
                Controller::redirect("/default/blocked/{$data['ip_address']}");
                exit;
            }
        }
    }
    public static function log_ip_saver($module,$action){
        $model = new Model();
        $date = new DateTime();
        $data = array(
            'ip_address' => USER_IP,
            'module'     => $module,
            'action'     => $action
        );
        if(isset($_SESSION['user'])){
            $data['user_id'] = $_SESSION['user']['ID'];
        }
        $model->db->insert("log_ip_addresses",$data);
    }
    public function log_ip_block($block_reson = null){
        $model = new Model();
        $date = new DateTime();
        $data = array(
            'ip_address' => USER_IP,
            'blocked_date' => $date->getTimestamp(),
            'ban_reson' => $block_reson
        );
        if(isset($_SESSION['user'])){
            $data['user_id'] = $_SESSION['user']['ID'];
        }
        $model->db->insert("log_blocked_ip_addresses",$data);
    }
}

?>