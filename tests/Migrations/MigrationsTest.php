<?php

require 'application\migrations\Migrations.php';


// function currentAutoload($classname){
//     $filename = $classname.'.php';
//     @require $filename;
// }

// spl_autoload_register('currentAutoload');

use PHPUnit\Framework\TestCase;
use application\migrations\Migrations;


class MigrationsTest extends TestCase
{

    protected $mgr;

    function __construct()
    {
        parent::__construct();
        $this->mgr = new Migrations;
    }
    public function testMigrations(){
        $stack = [];
        $this->assertSame(0, count($stack));
    }

    /**
     * @dataProvider 
     */

    public function testCompareSql(){

    }
}