<?php

namespace myfinance\test\repositories\factories;

use myfinance\repositories\factories\CategoryRepositoryFactory;

class CategoryRepositoryFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateMysqlCategoryRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = CategoryRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\MysqlCategoryRepository::class));
    }

    public function testCreateDummyCategoryRepository() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\DummyDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);

        $repo = CategoryRepositoryFactory::create($contextMock);

        $this->assertTrue(is_a($repo, \myfinance\repositories\DummyCategoryRepository::class));
    }

}
