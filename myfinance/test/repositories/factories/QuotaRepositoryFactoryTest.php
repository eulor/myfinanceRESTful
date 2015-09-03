<?php

namespace myfinance\test\repositories\factories;

use myfinance\repositories\factories\QuotaRepositoryFactory;

class QuotaRepositoryFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateMysqlBudgetaryItemRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = QuotaRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\MysqlQuotaRepository::class));
    }

    public function testCreateDummyAccountRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\DummyDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = QuotaRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\DummyQuotaRepository::class));
    }

}
