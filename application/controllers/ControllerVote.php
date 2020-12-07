<?php


namespace application\controllers;

use application\models\ModelShow;

class ControllerVote extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new ModelShow;
    }

    function actionIndex(){

    }
    
}