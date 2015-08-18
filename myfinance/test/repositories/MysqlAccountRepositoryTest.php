<?php

namespace myfinance\test\repositories;

use myfinance\repositories\MysqlAccountRepository;

class MysqlAccountRepositoryTest extends \PHPUnit_Framework_TestCase {

    public function testInitializeDbAndUserFromContext() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn(\Phake::mock('myfinance\db\MysqlDB'));
        $repo = new MysqlAccountRepository($contextMock);

        \Phake::verify($contextMock)->getUser();
        \Phake::verify($contextMock)->getDb();
    }

    public function testGetOneAccount() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlAccountRepository($context);
        $id = 12;

        $result = $repo->get($id);

        $this->assertTrue(is_a($result, \myfinance\model\Account::class));
    }

    public function testGetAllAccounts() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlAccountRepository($context);

        $result = $repo->getAll();

        $this->assertTrue(is_array($result));
    }

    public function testGetInvokesCorrectMethodsOnDb() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlAccountRepository($context);
        $id = 12;

        $repo->get($id);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
        \Phake::verify($dbMock)->fetch_assoc(\Phake::ignoreRemaining());
    }

    public function testUpdate() {
        $accountMock = \Phake::mock('myfinance\model\Account');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($accountMock->id)->thenReturn($accountMock);
        $repo = new MysqlAccountRepository($contextMock);

        $result = $repo->update($accountMock);

        $this->assertTrue(is_a($result, \myfinance\model\Account::class));
    }

    public function testCreate() {
        $accountMock = \Phake::mock('myfinance\model\Account');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get(\Phake::ignoreRemaining())->thenReturn($accountMock);
        $repo = new MysqlAccountRepository($contextMock);

        $result = $repo->create($accountMock);

        $this->assertTrue(is_a($result, \myfinance\model\Account::class));
    }

    public function testDelete() {
        $accountMock = \Phake::mock('myfinance\model\Account');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($accountMock->id)->thenReturn($accountMock);
        $repo = new MysqlAccountRepository($contextMock);

        $result = $repo->delete($accountMock);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteById() {
        $accountMock = \Phake::mock('myfinance\model\Account');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($accountMock->id)->thenReturn($accountMock);
        $repo = new MysqlAccountRepository($contextMock);
        $id = 1;

        $repo->deleteById($id);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteByNegativeIdExpectException() {
        $accountMock = \Phake::mock('myfinance\model\Account');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(false);
        \Phake::when($dbMock)->get($accountMock->id)->thenReturn($accountMock);
        $repo = new MysqlAccountRepository($contextMock);
        $id = -1;

        $this->setExpectedException('Exception');

        $repo->deleteById($id);
    }

}
