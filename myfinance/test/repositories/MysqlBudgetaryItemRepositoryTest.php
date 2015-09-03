<?php

namespace myfinance\test\repositories;

use myfinance\repositories\MysqlBudgetaryItemRepository;

class MysqlBudgetaryItemRepositoryTest extends \PHPUnit_Framework_TestCase {

    public function testInitializeDbAndUserFromContext() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn(\Phake::mock('myfinance\db\MysqlDB'));
        $repo = new MysqlBudgetaryItemRepository($contextMock);

        \Phake::verify($contextMock)->getUser();
        \Phake::verify($contextMock)->getDb();
    }

    public function testGetOneBudgetaryItem() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlBudgetaryItemRepository($context);
        $id = 12;

        $result = $repo->get($id);

        $this->assertTrue(is_a($result, \myfinance\model\BudgetaryItem::class));
    }

    public function testGetAllBudgetaryItems() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlBudgetaryItemRepository($context);

        $result = $repo->getAll();

        $this->assertTrue(is_array($result));
    }

    public function testCreate() {
        $budgetaryItemMock = \Phake::mock('myfinance\model\BudgetaryItem');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get(\Phake::ignoreRemaining())->thenReturn($budgetaryItemMock);
        $repo = new MysqlBudgetaryItemRepository($contextMock);

        $result = $repo->create($budgetaryItemMock);

        $this->assertTrue(is_a($result, \myfinance\model\BudgetaryItem::class));
    }

    public function testDelete() {
        $budgetaryItemMock = \Phake::mock('myfinance\model\BudgetaryItem');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($budgetaryItemMock->id)->thenReturn($budgetaryItemMock);
        $repo = new MysqlBudgetaryItemRepository($contextMock);

        $result = $repo->delete($budgetaryItemMock);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteById() {
        $budgetaryItemMock = \Phake::mock('myfinance\model\BudgetaryItem');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($budgetaryItemMock->id)->thenReturn($budgetaryItemMock);
        $repo = new MysqlBudgetaryItemRepository($contextMock);
        $id = 1;

        $repo->deleteById($id);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteByNegativeIdExpectException() {
        $budgetaryItemMock = \Phake::mock('myfinance\model\BudgetaryItem');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(false);
        \Phake::when($dbMock)->get($budgetaryItemMock->id)->thenReturn($budgetaryItemMock);
        $repo = new MysqlBudgetaryItemRepository($contextMock);
        $id = -1;

        $this->setExpectedException('Exception');

        $repo->deleteById($id);
    }

}
