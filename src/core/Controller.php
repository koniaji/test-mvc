<?php


namespace App\core;


class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
        $this->view->layout = APP_DIR . '/views/layout/main.php';
    }
}
