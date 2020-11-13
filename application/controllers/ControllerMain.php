<?php


namespace application\controllers;

class ControllerMain extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function actionIndex(){
        return $this->view->generate('ViewMain.php', 'ViewTemplate.php'); 
    }

}