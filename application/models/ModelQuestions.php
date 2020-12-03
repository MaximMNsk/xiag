<?php

namespace application\models;
use application\models\Model;

class ModelQuestions extends Model
{
    function __construct()
    {
        parent::__construct('mysql', DB['SERVER'], DB['DBNAME'], DB['USERNAME'], DB['PWD']);
    }

    function saveSome(){
        $res = $this->makeRequest(['sql' => 'select * from poll', 'params'=>[]]);
        return $res;
    }
}