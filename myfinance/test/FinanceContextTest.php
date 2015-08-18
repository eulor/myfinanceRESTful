<?php

namespace myfinance\test;
use myfinance\FinanceContext;

class FinanceContextTest extends \PHPUnit_Framework_TestCase {

    public function testGetDb() {
        $dbMock = \Phake::mock('myfinance\db\DB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new FinanceContext($dbMock, $userMock);

        $result = $context->getDb();

        $this->assertEquals($dbMock, $result);
    }

    public function testGetUser() {
        $dbMock = \Phake::mock('myfinance\db\DB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new FinanceContext($dbMock, $userMock);

        $result = $context->getUser();

        $this->assertEquals($userMock, $result);
    }

}
