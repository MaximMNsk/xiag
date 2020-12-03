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
        foreach ($arr as $val){
            if( empty($val) ) return false;
        } 
        return true;
    }

}