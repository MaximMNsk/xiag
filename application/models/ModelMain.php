<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelQuestions.php';
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
        // var_dump($this->modelValidate->emptyVals($data));
        if( !$this->modelValidate->emptyVals($data) ) return false;
        $question = $data['question'];
        $answers = array_diff_key($data, ['question' => '']);
        $this->modelPoll->question = $question;
        $this->modelPoll->save();
        $link = ($this->modelPoll->uuid) ? $this->modelPoll->uuid : false;
        return $link;
    }
    

}
