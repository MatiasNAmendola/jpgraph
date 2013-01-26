<?php

abstract class Action {

    protected $class;
    protected $viewVars = array();

    public function setClass($class) {
        $this->class = $class;
    }

    public function getClass() {
        return $this->class;
    }

    public function setVar($key, $value) {
        $this->viewVars[$key] = $value;
    }

    public function dispatchAction($action) {
        $this->$action();
        $this->displayView($action);
    }

    private function displayView($action) {
        foreach ($this->viewVars as $key => $value) {
            $$key = $value;
        }
        include('view/' . $this->getClass() . ".php");
    }

}
