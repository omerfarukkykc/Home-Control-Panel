<?php

    class defaultController extends Controller implements FrontController {
        public function dashboardAction($param = null)
        {
            $this->RenderLayout("default","default", "dashboard");
        }
        public function contactusAction(){
            $this->RenderLayout("default","default", "contactus");
        }
        public function blockedAction($ip_address,$ban_reson=null){
            echo "{$ip_address} ip adresli kullanıcı engellenmiştir engelin kalkması için lütfen iletişime geçin<br>";
            echo ($ban_reson!=null)?"Ban sebebi : {$ban_reson}":null;
        }
    }

?>