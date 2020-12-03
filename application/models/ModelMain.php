<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelQuestions.php';
require 'ModelValidate.php';

use application\models\ModelPoll;
use application\models\ModelQuestions;
use application\models\ModelValidate;

class ModelMain 
{

    function __construct()
    {
        $this->modelPoll = new ModelPoll;
        $this->modelQuestions = new ModelQuestions;
        $this->modelValidate = new ModelValidate;
    }

    function savePoll( $data=[] ){
        if( !$this->modelValidate->emptyVals($data) ) return false;
        $question = $data['question'];
        $answers = array_diff_key($data, ['question' => '']);
        $this->modelPoll->question = $question;
        $pollId = $this->modelPoll->save();
        $link = ($pollId) ? $this->modelPoll->getLink($pollId) : false;
        return $link;
    }
    

}
