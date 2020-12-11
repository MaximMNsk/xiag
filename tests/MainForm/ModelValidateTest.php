<?php

require 'application/models/ModelValidate.php';

use PHPUnit\Framework\TestCase;
use application\models\ModelValidate;


class ModelValidateTest extends TestCase
{

    function __construct($name = null, array $data = array(), $dataName = '')
    {
        $this->modelValidate = new ModelValidate;
        parent::__construct($name, $data, $dataName);
    }
    
    /**
     * @dataProvider  dataProvider
     * 
     */
    public function testValidate($arr, $expected) 
    {
        $this->assertEquals($expected, $this->modelValidate->emptyVals($arr));
    }

    public function dataProvider()
    {
        return [
            [[], false],
            [[0=>'a', 1=>null, 2=>'b'], false],
            [[0=>'a', 1=>false], false],
            [[0=>'a', 1=>'b'], true],
        ];
    }

}