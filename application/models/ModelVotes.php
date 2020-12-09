<?php

namespace application\models;
use application\models\Model;

class ModelVotes extends Model
{

    public $vote; 
    public $id;
    public $duplicate;
    public $pollId;

    function __construct()
    {
        $this->duplicate = false;
        parent::__construct('mysql', DB['SERVER'], DB['DBNAME'], DB['USERNAME'], DB['PWD']);
    }

    function save(){
        $sql = 'insert into votes (poll_id, answer_id, author, browser_id) values (:poll_id, :answer_id, :author, :browser_id)';
        $params = [
            ':poll_id' => $this->vote['pollId'],
            ':answer_id' => $this->vote['answerId'], 
            ':author' => $this->vote['userName'], 
            ':browser_id' => $this->vote['browserId']
        ];
        if($this->dataExists()==0){
            $this->id = $this->makeRequest(['sql' => $sql, 'params'=>$params]);
        }else{
            $this->id = false;
            $this->duplicate = true;
        }
    }

    // function getData(){
    //     $sql = 'select * from votes where id = :id';
    //     $params = [':id' => $this->id];
    //     $res = $this->makeRequest(['sql' => $sql, 'params' => $params]);
    //     return ($res) ? $res[0] : $res;
    // }

    function dataExists(){
        $res = [];
        $sql = 'select * from votes where author = :author and browser_id = :browser_id';
        $params = [
            ':author' => $this->vote['userName'], 
            ':browser_id' => $this->vote['browserId']
        ];
        $res = $this->id = $this->makeRequest(['sql' => $sql, 'params'=>$params]);
        return count($res);
    }

    // function getUuid( $id ){
    //     $data = $this->makeRequest(['sql' => 'select uuid from poll where id = :id', 'params'=>[':id' => $id]]);
    //     return isset($data[0]['uuid']) ? $data[0]['uuid'] : false;
    // }

    // function getId( $uuid ){
    //     $data = $this->makeRequest(['sql' => 'select id from poll where uuid = :uuid', 'params'=>[':uuid' => $uuid]]);
    //     return isset($data[0]['id']) ? $data[0]['id'] : false;
    // }
}