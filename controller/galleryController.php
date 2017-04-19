<?php
class galleryController{
    public function index(){
        $view = new View('gallery_index');
        $view->display();
    }
}