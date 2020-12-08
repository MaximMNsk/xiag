<?php

namespace application\models;
use application\models\Model;

class ModelAnswers extends Model
{
    
    public $answers;
    public $parentId;

    function __construct()
    {
        parent::__construct('mysql', DB['SERVER'], DB['DBNAME'], DB['USERNAME'], DB['PWD']);
    }

    function save(){
        if( !is_array($this->answers) ) return false;
        $sql = 'insert into answers (parent_id, answer) values ';
        foreach($this->answers as $k => $answer){
            $k = str_replace('-', '_', $k);
            $sql .= '(:parent_'.$k.'_id, :'.$k.'), ';
            $params[':parent_'.$k.'_id'] = $this->parentId;
            $params[':'.$k] = $answer;
        }
        $sql = rtrim($sql, ', ');
        $res = $this->makeRequest(['sql' => $sql, 'params'=>$params]);
        return $res;
    }

    function getData(){
        $sql = 'select * from answers where parent_id = :id';
        $params = [':id' => $this->parentId];
        return $this->makeRequest(['sql' => $sql, 'params' => $params]);
    }
}