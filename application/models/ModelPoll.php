<?php

namespace application\models;
use application\models\Model;

class ModelPoll extends Model
{

    public $question; 
    public $id;
    public $uuid;

    function __construct()
    {
        parent::__construct('mysql', DB['SERVER'], DB['DBNAME'], DB['USERNAME'], DB['PWD']);
    }

    function save(){
        $this->id = $this->makeRequest(['sql' => 'insert into poll (poll_question) values (:question)', 'params'=>[':question' => $this->question]]);
        $this->uuid = $this->getUuid( $this->id );
    }

    function getUuid( $id ){
        $data = $this->makeRequest(['sql' => 'select uuid from poll where id = :id', 'params'=>[':id' => $id]]);
        return isset($data[0]['uuid']) ? $data[0]['uuid'] : false;
    }

    function getId( $uuid ){
        $data = $this->makeRequest(['sql' => 'select id from poll where uuid = :uuid', 'params'=>[':uuid' => $uuid]]);
        return isset($data[0]['id']) ? $data[0]['id'] : false;
    }
}