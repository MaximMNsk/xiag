<?php

include 'migrations.php';
use application\migrations\Migrations;

$migrate = new Migrations;

$result = $migrate->start();


if( !$result ){
    echo 'No files to migration';
}else{
    echo 'Result:'. "\r\n";
    foreach($result as $fileName => $answer){
        echo 'File '.$fileName.' was loaded with result '.$answer. "\r\n";
    }
}