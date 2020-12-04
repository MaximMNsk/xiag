<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelAnswers.php';
require 'ModelValidate.php';

use application\models\ModelPoll;
use application\models\ModelAnswers;
use application\models\ModelValidate;

class ModelMain 
{

    function __construct()
    {
        $this->modelPoll = new ModelPoll;
        $this->modelAnswers = new ModelAnswers;
        $this->modelValidate = new ModelValidate;
    }

    function savePoll( $data=[] ){
        if( !$this->modelValidate->emptyVals($data) ) return false;

        $question = $data['question'];
        $answers = array_diff_key($data, ['question' => '']);

        $this->modelPoll->question = $question;
        $this->modelPoll->save();
        $link = ($this->modelPoll->uuid) ? $this->modelPoll->uuid : false;

        if(!$link) return false;

        $this->modelAnswers->answers = $answers;
        $this->modelAnswers->parentId = $this->modelPoll->id;
        $answerId = $this->modelAnswers->save();
        
        $res = ($answerId) ? $link : false;
        return $res;
    }
    

}
