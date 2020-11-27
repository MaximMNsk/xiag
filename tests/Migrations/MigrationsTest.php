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
    public function testCompareSameFiles($expected)  // if files in .lst is the same as in "sql" folder, or files in "sql" is absent
    {
        $this->assertEquals($expected, $this->mgr->compareSql());
    }

    public function filesProvider()
    {
        return [
            [[]]
        ];
    }

    public function testCompareFiles() 
    {
        $this->assertIsArray( $this->mgr->compareSql() );
    }


    public function testSaveInFile()
    {
        $fileName = 'testMgrFile';
        $this->assertIsNumeric( $this->mgr->saveName($fileName) );
    }
}