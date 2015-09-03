<?php

namespace myfinance\test\repositories;
use myfinance\repositories\MysqlAccountingEntryRepository;
class MysqlAccountingEntryRepositoryTest extends \PHPUnit_Framework_TestCase {
    public function testInitializeDbAndUserFromContext() {
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn(\Phake::mock('myfinance\db\MysqlDB'));
        $repo = new MysqlAccountingEntryRepository($contextMock);

        \Phake::verify($contextMock)->getUser();
        \Phake::verify($contextMock)->getDb();
    }
public function testGetOneAccountingEntry() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlAccountingEntryRepository($context);
        $id = 12;

        $result = $repo->get($id);

        $this->assertTrue(is_a($result, \myfinance\model\AccountingEntry::class));
    }

    public function testGetAllAccountingEntries() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlAccountingEntryRepository($context);

        $result = $repo->getAll();

        $this->assertTrue(is_array($result));
    }
    
     public function testGetInvokesCorrectMethodsOnDb() {
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        $userMock = \Phake::mock('myfinance\model\User');
        $context = new \myfinance\FinanceContext($dbMock, $userMock);
        $repo = new MysqlAccountingEntryRepository($context);
        $id = 12;

        $repo->get($id);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
        \Phake::verify($dbMock)->fetch_assoc(\Phake::ignoreRemaining());
    }
    
    public function testUpdate() {
        $accountingEntryMock = \Phake::mock('myfinance\model\AccountingEntry');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($accountingEntryMock->id)->thenReturn($accountingEntryMock);
        $repo = new MysqlAccountingEntryRepository($contextMock);

        $result = $repo->update($accountingEntryMock);

        $this->assertTrue(is_a($result, \myfinance\model\AccountingEntry::class));
    }
public function testCreate() {
        $accountingEntryMock = \Phake::mock('myfinance\model\AccountingEntry');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get(\Phake::ignoreRemaining())->thenReturn($accountingEntryMock);
        $repo = new MysqlAccountingEntryRepository($contextMock);

        $result = $repo->create($accountingEntryMock);

        $this->assertTrue(is_a($result, \myfinance\model\AccountingEntry::class));
    }
    
    public function testDelete() {
        $accountingEntryMock = \Phake::mock('myfinance\model\AccountingEntry');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($accountingEntryMock->id)->thenReturn($accountingEntryMock);
        $repo = new MysqlAccountingEntryRepository($contextMock);

        $result = $repo->delete($accountingEntryMock);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteById() {
        $accountingEntryMock = \Phake::mock('myfinance\model\AccountingEntry');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(true);
        \Phake::when($dbMock)->get($accountingEntryMock->id)->thenReturn($accountingEntryMock);
        $repo = new MysqlAccountingEntryRepository($contextMock);
        $id = 1;

        $repo->deleteById($id);

        \Phake::verify($dbMock)->query(\Phake::ignoreRemaining());
    }

    public function testDeleteByNegativeIdExpectException() {
        $accountingEntryMock = \Phake::mock('myfinance\model\AccountingEntry');
        $contextMock = \Phake::mock('myfinance\FinanceContext');
        $dbMock = \Phake::mock('myfinance\db\MysqlDB');
        \Phake::when($contextMock)->getUser()->thenReturn(\Phake::mock('myfinance\model\User'));
        \Phake::when($contextMock)->getDb()->thenReturn($dbMock);
        \Phake::when($dbMock)->query(\Phake::ignoreRemaining())->thenReturn(false);
        \Phake::when($dbMock)->get($accountingEntryMock->id)->thenReturn($accountingEntryMock);
        $repo = new MysqlAccountingEntryRepository($contextMock);
        $id = -1;

        $this->setExpectedException('Exception');

        $repo->deleteById($id);
    }

}
