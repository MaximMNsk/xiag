<?php


namespace application\controllers;

use application\models\ModelShow;

class ControllerShow extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new ModelShow;
    }

    function actionPoll(){
        $data = $this->model->getPollUUID();
        return $this->view->generate('ViewShow.php', 'ViewTemplate.php', $data); 
    }

    
}