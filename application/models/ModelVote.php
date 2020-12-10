<?php

namespace application\models;

require 'ModelPoll.php';
require 'ModelValidate.php';
require 'ModelErrors.php';
require 'ModelVotes.php';


use application\models\ModelPoll;
use application\models\Model;
use application\models\ModelValidate;
use application\models\ModelErrors;
use application\models\ModelVotes;

class ModelVote extends Model
{
    
    function __construct()
    {
        $this->modelPoll = new ModelPoll;
        $this->modelValidate = new ModelValidate;
        $this->modelVotes = new ModelVotes;
        $this->modelErrors = new ModelErrors;
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
        $data = json_encode($this->getData( $data ));
        print $data;
        return file_put_contents(WSS['CACHE_PATH'].'/votes.cache', $data);
    }

}