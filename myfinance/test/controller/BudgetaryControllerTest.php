<?php

namespace myfinance\test\controller;

use myfinance\controller\BudgetaryController;

class BudgetaryControllerTest extends \PHPUnit_Framework_TestCase {

    public function testGetOneBudgetaryItem() {
        $budgetaryItemRepoMock = \Phake::mock('myfinance\repositories\BudgetaryItemRepository');
        $controller = new BudgetaryController($budgetaryItemRepoMock);
        $id = 1;

        $controller->get($id);

        \Phake::verify($budgetaryItemRepoMock)->get($id);
    }

    public function testGetAllBudgetaryItems() {
        $budgetaryItemRepoMock = \Phake::mock('myfinance\repositories\BudgetaryItemRepository');
        $controller = new BudgetaryController($budgetaryItemRepoMock);

        $controller->get();

        \Phake::verify($budgetaryItemRepoMock)->getAll();
    }

    public function testDelete() {
        $budgetaryItemRepoMock = \Phake::mock('myfinance\repositories\BudgetaryItemRepository');
        $controller = new BudgetaryController($budgetaryItemRepoMock);
        $id = 1;

        $controller->delete($id);

        \Phake::verify($budgetaryItemRepoMock)->deleteById($id);
    }

    public function testPut() {
        $budgetaryItemRepoMock = \Phake::mock('myfinance\repositories\BudgetaryItemRepository');
        $controller = new BudgetaryController($budgetaryItemRepoMock);
        $json = '{"id":"1","description":"Autoausgaben"}';

        $controller->put(json_decode($json));

        \Phake::verify($budgetaryItemRepoMock)->update(\Phake::ignoreRemaining());
    }

    public function testPost() {
        $budgetaryItemRepoMock = \Phake::mock('myfinance\repositories\BudgetaryItemRepository');
        $controller = new BudgetaryController($budgetaryItemRepoMock);
        $json = '{"description":"Autoausgaben"}';

        $controller->post(json_decode($json));

        \Phake::verify($budgetaryItemRepoMock)->create(\Phake::ignoreRemaining());
    }

}
