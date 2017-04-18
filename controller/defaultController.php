<?php
class DefaultController{

    public function index(){
        $view = new View('default_index');
        $view->display();
    }
}
?>