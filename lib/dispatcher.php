<?php
class Dispatcher
{

    public static function dispatch()
    {
        // Die URI wird aus dem $_SERVER Array ausgelesen und in ihre
        //   Einzelteile zerlegt.
        // /user/index/foo --> ['user', 'index', 'foo']
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?'); // Erstes ? und alles danach abschneiden
        $uri = trim($uri, '/'); // Alle / am anfang und am Ende der URI abschneiden
        $uriFragments = explode('/', $uri); // In einzelteile zerlegen

        $controllerName = 'defaultController';
        if (!empty($uriFragments[0])) {
            $controllerName = $uriFragments[0];
            $controllerName .= 'Controller';
        }

        $method = 'index';
        if (!empty($uriFragments[1])) {
            $method = $uriFragments[1];
        }

        $args = array_slice($uriFragments, 2);

        require_once "../controller/$controllerName.php";

        $controller = new $controllerName();
        $controller->$method();
    }
}