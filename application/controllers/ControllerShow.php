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

    function actionIndex(){
        Route::ErrorPage404();
    }

    function actionPoll(){
        $currentUuid = $this->model->getPollUUID();
        if( $id = $this->model->pollExists($currentUuid) ){
            $data['poll'] = $this->model->getPollData( $id );
            $data['answers'] = $this->model->getAnswersData( $id );
            return $this->view->generate('ViewShow.php', 'ViewTemplate.php', $data); 
        } else {
            Route::ErrorPage404();
        }
    }

    
}