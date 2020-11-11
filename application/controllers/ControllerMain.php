<?php


namespace application\controllers;

class ControllerMain extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function actionIndex(){
        $this->view->generate('ViewMain.php', 'ViewTemplate.php'); 
    }

}