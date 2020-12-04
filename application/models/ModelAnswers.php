<?php

namespace application\models;
use application\models\Model;

class ModelAnswers extends Model
{
    
    public $answers;

    function __construct()
    {
        parent::__construct('mysql', DB['SERVER'], DB['DBNAME'], DB['USERNAME'], DB['PWD']);
    }

    function save(){
        
        $res = $this->makeRequest(['sql' => 'select * from poll', 'params'=>[]]);
        return $res;
    }
}