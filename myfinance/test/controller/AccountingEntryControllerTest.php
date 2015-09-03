<?php

namespace myfinance\test\controller;

use myfinance\controller\AccountingEntryController;

class AccountingEntryControllerTest extends \PHPUnit_Framework_TestCase {

    public function testGetOneBudgetaryItem() {
        $accountingEntryRepoMock = \Phake::mock('myfinance\repositories\AccountingEntryRepository');
        $controller = new AccountingEntryController($accountingEntryRepoMock);
        $id = 1;

        $controller->get($id);

        \Phake::verify($accountingEntryRepoMock)->get($id);
    }

    public function testGetAllBudgetaryItems() {
        $accountingEntryRepoMock = \Phake::mock('myfinance\repositories\AccountingEntryRepository');
        $controller = new AccountingEntryController($accountingEntryRepoMock);

        $controller->get();

        \Phake::verify($accountingEntryRepoMock)->getAll();
    }

    public function testDelete() {
        $accountingEntryRepoMock = \Phake::mock('myfinance\repositories\AccountingEntryRepository');
        $controller = new AccountingEntryController($accountingEntryRepoMock);
        $id = 1;

        $controller->delete($id);

        \Phake::verify($accountingEntryRepoMock)->deleteById($id);
    }

    public function testPut() {
        $accountingEntryRepoMock = \Phake::mock('myfinance\repositories\AccountingEntryRepository');
        $controller = new AccountingEntryController($accountingEntryRepoMock);
        $json = '{"id":"1","description":"Autoausgaben"}';

        $controller->put(json_decode($json));

        \Phake::verify($accountingEntryRepoMock)->update(\Phake::ignoreRemaining());
    }

    public function testPost() {
        $accountingEntryRepoMock = \Phake::mock('myfinance\repositories\AccountingEntryRepository');
        $controller = new AccountingEntryController($accountingEntryRepoMock);
        $json = '{"amount":"12.15",description":"Reperatur bei Autohaus","date":"2015-09-03","account":"1","category","2"}';

        $controller->post(json_decode($json));

        \Phake::verify($accountingEntryRepoMock)->create(\Phake::ignoreRemaining());
    }

}
