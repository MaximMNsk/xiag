<?php

namespace application\models;

class ModelErrors
{

    public $errCode;
    public $errText;

    function getTextByCode(){
        $errors = $this->errors();
        return $this->errText = ( array_key_exists($this->errCode, $errors) ) ? $errors[$this->errCode] : 'Unknown error'; 
    }

    function errors(){
        return [
            0 => 'Successfully completed',
            101 => 'Poll saving errors',
            102 => 'Poll answers saving errors',
            201 => 'Empty fields detected. All fields required',
            301 => 'You have already voted',
        ];
    }

}