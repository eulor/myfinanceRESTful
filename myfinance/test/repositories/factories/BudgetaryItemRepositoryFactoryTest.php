<?php

namespace myfinance\test\repositories\factories;

use myfinance\repositories\factories\BudgetaryItemRepositoryFactory;

class BudgetaryItemRepositoryFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateMysqlBudgetaryItemRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = BudgetaryItemRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\MysqlBudgetaryItemRepository::class));
    }

    public function testCreateDummyAccountRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\DummyDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = BudgetaryItemRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\DummyBudgetaryItemRepository::class));
    }

}
