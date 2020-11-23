<?php

namespace application\migrations;
include $config = (file_exists('config.php')) ? 'config.php' : '../../config.php';
include PATH["ROOT"].'application\\core\\model.php';
use application\models\Model;

class Migrations extends Model
{
    function __construct()
    {
        parent::__construct('mysql', DB['SERVER'], '', DB['USERNAME'], DB['PWD']);
    }

    function start(){
        $sqlFiles = $this->compareSql();
        return $this->execSql( $sqlFiles );
    }

    function compareSql(){
        $executedFilesStr = file_get_contents('./.lst');
        $executedFiles = ( $executedFilesStr ) ? array_diff(explode('|', $executedFilesStr), ['']) : [];
        $migrationFiles = array_diff(scandir('./sql'), array('..', '.'));
        return $diff = array_diff($migrationFiles, $executedFiles);
    }

    function execSql( $files ){
        if( !$files ) return false;
        $res = [];
        foreach($files as $file){
            $sql = file_get_contents( './sql/'.$file );
            if( $this->makeRequest( ['sql'=>$sql, 'params'=>[]] ) ){
                $this->saveName( $file );
                $res[$file] = 'Success';
            } else{
                $res[$file] = 'Error';
            }
        }
        return $res;
    }

    function saveName( $fileName ){
        file_put_contents('./.lst', $fileName.'|');
    }
}