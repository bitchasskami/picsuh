<?php
class View{

    private $properties = array();
    private $view;

    public function __construct($view){
        $this->view = "../view/$view.php";
    }


    public function __set($key, $value)
    {
        if (!isset($this->$key)) {
            $this->properties[$key] = $value;
        }
    }

    public function __get($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }
    }

    public function display(){
        extract($this->properties);

        require '../view/header.php';
        require $this->view;
        require '../view/footer.php';
    }
}
?>