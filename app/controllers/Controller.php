<?php

class Controller
{
    protected function view()
    {
        $contentView = $this->getCurrentViewPath();
        require_once '../app/views/index.php';
    }

    private function getCurrentViewPath()
    {
        $controller = str_replace('Controller', '', get_called_class());
        $action = strtolower(str_replace('Action', '', debug_backtrace()[2]['function']));
        return "../app/views/{$controller}/{$action}.php";
    }
}
