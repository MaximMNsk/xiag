<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelValidate.php';
require 'ModelErrors.php';
require 'ModelVotes.php';
require 'ModelAnswers.php';


use application\models\ModelPoll;
use application\models\Model;
use application\models\ModelValidate;
use application\models\ModelErrors;
use application\models\ModelVotes;
use application\models\ModelAnswers;

class ModelVote extends Model
{
    
    function __construct()
    {
        $this->modelPoll = new ModelPoll;
        $this->modelValidate = new ModelValidate;
        $this->modelVotes = new ModelVotes;
        $this->modelErrors = new ModelErrors;
        $this->modelAnswers = new ModelAnswers;
    }

    function save( $data ){
        if( !$this->modelValidate->emptyVals( $data ) ){
            $event['code'] = 201;
        }else{
            $this->modelVotes->vote = $data;
            $this->modelVotes->save();
            $id = ($this->modelVotes->id) ? $this->modelVotes->id : false;
            $duplicate = $this->modelVotes->duplicate;
    
            if($duplicate && !$id){
                $event['code'] = 301; // Duplicate
            }elseif(!$id){
                $event['code'] = 101;
            }else{
                $event['code'] = 0;
            }
        }

        $this->modelErrors->errCode = $event['code'];
        $this->modelErrors->getTextByCode();
        $event['text'] = $this->modelErrors->errText;

        return $event;
    }

    function getData( $data ){
        return $this->modelVotes->getLastVoteData( $data );
    }

    function cacheVotes( $data ){
        $votes = $this->getData( $data );
        $pollId = $votes[0]['poll_id'];
        $this->modelAnswers->parentId = $pollId;
        $poll = $this->modelAnswers->getData();
        $data = [
            'poll' => $poll,
            'votes' => $votes,
        ];
        $data = json_encode($data);
        return file_put_contents(WSS['CACHE_PATH'].'/'.$pollId.'.votes.cache', $data);
    }

}