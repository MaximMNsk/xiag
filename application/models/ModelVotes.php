<?php

namespace application\models;
use application\models\Model;

class ModelVotes extends Model
{

    public $vote; 
    public $id;
    public $duplicate;

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
        // var_dump($this->dataExists());
        if($this->dataExists()==0){
            $this->id = $this->makeRequest(['sql' => $sql, 'params'=>$params]);
            $this->duplicate = false;
        }else{
            $this->id = false;
            $this->duplicate = true;
        }
    }

    function getLastVoteData( $data ){
        $id = $data['pollId'];
        $sql = 'select * from votes where poll_id = :id';
        $params = [':id' => $id];
        $res = $this->makeRequest(['sql' => $sql, 'params' => $params ]);
        return $res;
    }

    function dataExists(){
        $sql = 'select * from votes where author = :author and browser_id = :browser_id and poll_id = :poll_id';
        $params = [
            ':author' => $this->vote['userName'], 
            ':browser_id' => $this->vote['browserId'],
            ':poll_id' => $this->vote['pollId'],
        ];
        $res = $this->id = $this->makeRequest(['sql' => $sql, 'params'=>$params]);
        return ($res) ? count($res) : 0;
    }

}