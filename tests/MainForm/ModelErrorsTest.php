<?php

require 'application/models/ModelErrors.php';

use PHPUnit\Framework\TestCase;
use application\models\ModelErrors;


class ModelErrorsTest extends TestCase
{

    // protected $modelErrors;

    function __construct($name = null, array $data = array(), $dataName = '')
    {
        $this->modelErrors = new ModelErrors;
        parent::__construct($name, $data, $dataName);
    }
    
    /**
     * @dataProvider  codeProvider
     * 
     */
    public function testTextByCode($code, $expected) 
    {
        $this->modelErrors->errCode = $code;
        $this->modelErrors->getTextByCode();
        $this->assertEquals($expected, $this->modelErrors->errText);
    }

    public function codeProvider()
    {
        return [
            [0, 'Successfully completed'],
            [101, 'Poll saving errors'],
            [500, 'Unknown error']
        ];
    }

}