<?php

class AboutController
{
    public function index($id, $user)
    {
        $model = new stdClass();
        $model->id = $id;
        $model->user = $user;
        require_once '../app/views/about/index.php';
    }
}
?>
