<?php

namespace myfinance\test\repositories;
use myfinance\repositories\MysqlCategoryRepository;

class MysqlCategoryRepositoryTest extends \PHPUnit_Framework_TestCase {
 public function testInitializeDbAndUserFromContext() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn(\Phake::mock('myfinance\db\MysqlDB'));
        $repo = new MysqlCategoryRepository($contextMock);

        \Phake::verify($contextMock)->getUser();
        \Phake::verify($contextMock)->getDb();
    }

    public function testGetOneCategory() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlCategoryRepository($context);
        $id = 12;

        $result = $repo->get($id);

        $this->assertTrue(is_a($result, \myfinance\model\Category::class));
    }

    public function testGetAllCategories() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlCategoryRepository($context);

        $result = $repo->getAll();

        $this->assertTrue(is_array($result));
    }

    public function testCreate() {
        $categoryMock = \Phake::mock('myfinance\model\Category');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get(\Phake::ignoreRemaining())->thenReturn($categoryMock);
        $repo = new MysqlCategoryRepository($contextMock);

        $result = $repo->create($categoryMock);

        $this->assertTrue(is_a($result, \myfinance\model\Category::class));
    }

    public function testDelete() {
        $categoryMock = \Phake::mock('myfinance\model\Category');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($categoryMock->id)->thenReturn($categoryMock);
        $repo = new MysqlCategoryRepository($contextMock);

        $result = $repo->delete($categoryMock);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteById() {
        $categoryMock = \Phake::mock('myfinance\model\Category');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($categoryMock->id)->thenReturn($categoryMock);
        $repo = new MysqlCategoryRepository($contextMock);
        $id = 1;

        $repo->deleteById($id);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteByNegativeIdExpectException() {
        $categoryMock = \Phake::mock('myfinance\model\Category');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(false);
        \Phake::when($dbMock)->get($categoryMock->id)->thenReturn($categoryMock);
        $repo = new MysqlCategoryRepository($contextMock);
        $id = -1;

        $this->setExpectedException('Exception');

        $repo->deleteById($id);
    }

}
