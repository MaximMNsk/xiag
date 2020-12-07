<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelAnswers.php';
require 'ModelValidate.php';
require 'ModelErrors.php';

use application\models\ModelPoll;
use application\models\ModelAnswers;
use application\models\ModelValidate;
use application\models\ModelErrors;

class ModelMain 
{

    function __construct()
    {
        $this->modelPoll = new ModelPoll;
        $this->modelAnswers = new ModelAnswers;
        $this->modelValidate = new ModelValidate;
        $this->modelErrors = new ModelErrors;
    }

    function savePoll( $data=[] ){
        $event['code'] = 0;
        $event['addData'] = '';
        $answerId = false;

        if( !$this->modelValidate->emptyVals($data) ){
            $event['code'] = 201;
        } else {
            $question = $data['question'];
            $answers = array_diff_key($data, ['question' => '']);
    
            $this->modelPoll->question = $question;
            $this->modelPoll->save();
            $link = ($this->modelPoll->uuid) ? $this->modelPoll->uuid : false;
    
            if(!$link){
                $event['code'] = 101;
            } else {
                $this->modelAnswers->answers = $answers;
                $this->modelAnswers->parentId = $this->modelPoll->id;
                $answerId = $this->modelAnswers->save();
            }
            
            if( !$answerId ){
                $event['code'] = 102;
            } else {
                $event['addData'] = $link;
            }
        }

        $this->modelErrors->errCode = $event['code'];
        $this->modelErrors->getTextByCode();
        $event['text'] = $this->modelErrors->errText;

        return $event;
    }
    

}
