<?php
class View{

    private $view;

    public function __construct($view){
        $this->view = "../view/$view.php";
}

    public function display(){
        require '../view/header.php';
        require $this->view;
        require '../view/footer.php';
    }
}
?>