<?php
include 'config.php';
include PATH["ROOT"].'application'.PATH["SEPARATOR"].'migrations'.PATH["SEPARATOR"].'Migrations.php';

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