<?php

    class defaultController extends Controller implements FrontController {
        public function dashboardAction($param = null)
        {
            $this->RenderLayout("default","default", "dashboard");
        }
        public function contactusAction(){
            $this->RenderLayout("default","default", "contactus");
        }
    }

?>