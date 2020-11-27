<?php

require 'application/migrations/Migrations.php';

use PHPUnit\Framework\TestCase;
use application\migrations\Migrations;


class MigrationsTest extends TestCase
{

    protected $mgr;

    function __construct($name = null, array $data = array(), $dataName = '')
    {
        $this->mgr = new Migrations;
        parent::__construct($name, $data, $dataName);
    }
    
    /**
     * @dataProvider  filesProvider
     * 
     */
    public function testCompareAbsentFiles($expected) 
    {
        $this->assertEquals($expected, $this->mgr->compareSql());
    }

    public function filesProvider()
    {
        return [
            [[]]
        ];
    }
}