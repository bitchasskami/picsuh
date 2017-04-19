<?php
class userController
{
    public function index(){
        $view = new View('user_index');
        $view->display();
    }

    public function registration(){
        $view = new View('registration_index');
        $view->display();
    }

    public function login(){
        $view = new VIew('login_index');
        $view->display();
    }

    public function doLogin(){

    }
}