<?php

namespace myfinance\test\repositories;

use myfinance\repositories\MysqlQuotaRepository;

class MysqlQuotaRepositoryTest extends \PHPUnit_Framework_TestCase {

    public function testInitializeDbAndUserFromContext() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn(\Phake::mock('myfinance\db\MysqlDB'));
        $repo = new MysqlQuotaRepository($contextMock);

        \Phake::verify($contextMock)->getUser();
        \Phake::verify($contextMock)->getDb();
    }

    public function testGetOneQuota() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlQuotaRepository($context);
        $id = 12;

        $result = $repo->get($id);

        $this->assertTrue(is_a($result, \myfinance\model\Quota::class));
    }

    public function testGetAllQuotas() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlQuotaRepository($context);

        $result = $repo->getAll();

        $this->assertTrue(is_array($result));
    }

    public function testCreate() {
        $quotaMock = \Phake::mock('myfinance\model\Quota');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get(\Phake::ignoreRemaining())->thenReturn($quotaMock);
        $repo = new MysqlQuotaRepository($contextMock);

        $result = $repo->create($quotaMock);

        $this->assertTrue(is_a($result, \myfinance\model\Quota::class));
    }

    public function testDelete() {
        $quotaMock = \Phake::mock('myfinance\model\Quota');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($quotaMock->id)->thenReturn($quotaMock);
        $repo = new MysqlQuotaRepository($contextMock);

        $result = $repo->delete($quotaMock);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteById() {
        $quotaMock = \Phake::mock('myfinance\model\Quota');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($quotaMock->id)->thenReturn($quotaMock);
        $repo = new MysqlQuotaRepository($contextMock);
        $id = 1;

        $repo->deleteById($id);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteByNegativeIdExpectException() {
        $quotaMock = \Phake::mock('myfinance\model\Quota');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(false);
        \Phake::when($dbMock)->get($quotaMock->id)->thenReturn($quotaMock);
        $repo = new MysqlQuotaRepository($contextMock);
        $id = -1;

        $this->setExpectedException('Exception');

        $repo->deleteById($id);
    }

}
