<?php


namespace application\controllers;

use application\models\ModelShow;
use Route;

class ControllerShow extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->model = new ModelShow;
    }

    function actionPoll(){
        $currentUuid = $this->model->getPollUUID();
        if( $data = $this->model->pollExists($currentUuid) ){
            return $this->view->generate('ViewShow.php', 'ViewTemplate.php', $data); 
        } else {
            Route::ErrorPage404();
        }
    }

    
}