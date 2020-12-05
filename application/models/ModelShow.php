<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelAnswers.php';

use application\models\ModelPoll;
use application\models\ModelAnswers;

class ModelShow
{

    function __construct()
    {
        $this->modelPoll = new ModelPoll;
        $this->modelAnswers = new ModelAnswers;
    }


    function getPollUUID(){
        $urlm = explode('/', $_SERVER['REQUEST_URI']);
        return isset($urlm[3]) ? $urlm[3] : 0;
    }

    function pollExists( $uuid ){
        return $this->modelPoll->getId( $uuid );
    }

    function getPollData( $id ){
        $this->modelPoll->id = $id;
        return $this->modelPoll->getData();
    }

    function getAnswersData( $id ){
        $this->modelAnswers->parentId = $id;
        return $this->modelAnswers->getData();
    }

}