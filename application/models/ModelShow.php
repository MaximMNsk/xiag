<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelAnswers.php';
require_once 'vendor/autoload.php';


use Workerman\Worker;
use application\models\ModelPoll;
use application\models\ModelAnswers;

class ModelShow
{

    function __construct()
    {
        $this->modelPoll = new ModelPoll;
        $this->modelAnswers = new ModelAnswers;
        $this->startWebSocketserver();
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

    function startWebSocketserver(){
        // print_r(
        // exec('php application/ws/server.php start &'));
    }

}