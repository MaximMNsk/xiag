<?php


namespace application\controllers;

use application\models\ModelVote;

class ControllerVote extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new ModelVote;
    }

    function actionIndex(){

    }

    function actionSave(){
        $data = $this->model->save( $_POST );
        return $this->view->generate('ViewJSONResp.php', 'ViewEmpty.php', $data); 
    }
    
}