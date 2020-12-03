<?php

namespace application\models;

use PDO;

class Model
{

    protected $db;

    function __construct($connectType='mysql', $serverName, $dbName, $username, $password){
        $conn = new PDO($connectType.':host='.$serverName.';dbname='.$dbName, $username, $password);
        $this->db = (!$conn) ? false : $conn ;
    }

    function makeRequest($options=[ 'sql'=>'select 1', 'params'=>[] ] ){ // options = ['sql'=>'', 'params'=>['bindName1'=>'bindValue1', ... , 'bindName2'=>'bindValue2']]
        $q = explode( ' ', strtolower(trim($options['sql'])) );
        $statement = $this->db->prepare( $options['sql'] );
        if(count( $options['params'] )>0){
            foreach($options['params'] as $k=>$v){
                $statement->bindParam( $k, $v );
            }
        }
        $statement->execute();
        if($q[0] == 'select'){
            if($statement->errorCode()=='00000'){
                $res = $statement->fetchAll();
                return $res;
            }else{
                return false;
            }
        }elseif($q[0] == 'insert'){
            if($statement->errorCode()=='00000'){
                $res = $this->db->lastInsertId();
                return $res;
            }else{
                return false;
            }
        }else{
            if ($statement->errorCode()=='00000') {
                return true;
            } else {
                return false;
            } 
        }
    }



}


