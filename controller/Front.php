<?php

require_once dirname(__FILE__) . "/action.php";

class Front {

    public function dispatch() {
        
        $class = !empty($_GET["page"]) ? $_GET["page"] : "SalesGraph";
        $action = !empty($_GET["action"]) ? $_GET["action"] : "index";
        
        require_once 'controller/' . $class . ".php";
        $viewPath = 'view/' . $class . ".php";
        $controller = new $class();
        
        if (!method_exists($controller, $action)) {
            throw new Exception('error: page method not found');
        }
        if (!is_file($viewPath)) {
            throw new Exception('error: page view not found');
        }
        $controller->setClass($class);
        $controller->dispatchAction($action);
    }

}