<?php

namespace application\models;

require 'ModelPoll.php';
use application\models\ModelPoll;

class ModelShow
{

    function __construct()
    {
        $this->modelPoll = new ModelPoll;
    }


    function getPollUUID(){
        $urlm = explode('/', $_SERVER['REQUEST_URI']);
        return $urlm[3];
    }

    function pollExists( $uuid ){
        return $this->modelPoll->getId( $uuid );
    }

}