<?php

namespace application\models;

class ModelValidate
{

    function emptyVals( $arr=[] ){
        if( is_array($arr) ){
            if(count($arr)==0) return false;
        } else {
            return false;
        }
        $flag = true;
        array_walk_recursive( $arr, function($val, $key) use (&$flag) {
            if( empty($val) ) $flag = false; 
        }, $flag);
        return $flag;
    }

}