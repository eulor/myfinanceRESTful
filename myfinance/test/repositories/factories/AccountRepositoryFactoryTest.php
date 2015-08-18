<?php

namespace myfinance\test\repositories\factories;

use myfinance\repositories\factories\AccountRepositoryFactory;

class AccountRepositoryFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateMysqlAccountRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = AccountRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\MysqlAccountRepository::class));
    }

    public function testCreateDummyAccountRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\DummyDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = AccountRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\DummyAccountRepository::class));
    }

}
