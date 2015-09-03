<?php

namespace myfinance\test\repositories\factories;
use myfinance\repositories\factories\AccountingEntryRepositoryFactory;

class AccountingEntryRepositoryFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateMysqlAccountingEntryRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = AccountingEntryRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\MysqlAccountingEntryRepository::class));
    }

    public function testCreateDummyAccountingEntryRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\DummyDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = AccountingEntryRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\DummyAccountingEntryRepository::class));
    }

}
