<?php


namespace application\controllers;
use application\models\ModelMain;

class ControllerMain extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new ModelMain;
    }

    function actionIndex(){
        return $this->view->generate('ViewMain.php', 'ViewTemplate.php'); 
    }

    function actionSave(){
        $data = $this->model->savePoll($_POST);
        return $this->view->generate('ViewJSONResp.php', 'ViewEmpty.php', $data); 
    }

    function actionShow(){
        return $this->view->generate('ViewShow.php', 'ViewTemplate.php');
    }

}