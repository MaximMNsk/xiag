<?php

namespace application\models;
use application\models\Model;

class ModelPoll extends Model
{

    public $question; 

    function __construct()
    {
        parent::__construct('mysql', DB['SERVER'], DB['DBNAME'], DB['USERNAME'], DB['PWD']);
    }

    function save(){
        return $this->makeRequest(['sql' => 'insert into poll (poll_question) values (:question)', 'params'=>[':question' => $this->question]]);
    }

    function getLink( $id ){
        return $this->makeRequest(['sql' => 'select uuid from poll where id = :id', 'params'=>[':id' => $id]]);
    }
}