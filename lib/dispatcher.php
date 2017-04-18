<?php
class Dispatcher{


    public function dispatch(){
        $uri = trim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
        $fragments = explode('/', $uri);

        $controllername = 'defaultController';
        if(!empty($fragments[0])){
            $controllername = $fragments[0];
            $controllername .= 'Controller';
        }

        $function = 'index';
        if(!empty($fragments[1])){
            $function = $fragments[1];
        }

        require_once "../controller/$controllername.php";

        $controller = new $controllername();
        $controller->$function();
}
}
?>