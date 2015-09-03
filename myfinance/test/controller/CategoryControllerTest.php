<?php

namespace myfinance\test\controller;

use myfinance\controller\CategoryController;

class CategoryControllerTest extends \PHPUnit_Framework_TestCase {

   public function testGetOneBudgetaryItem() {
        $categoryMock = \Phake::mock('myfinance\repositories\CategoryRepository');
        $controller = new CategoryController($categoryMock);
        $id = 1;

        $controller->get($id);

        \Phake::verify($categoryMock)->get($id);
    }

    public function testGetAllBudgetaryItems() {
        $categoryMock = \Phake::mock('myfinance\repositories\CategoryRepository');
        $controller = new CategoryController($categoryMock);

        $controller->get();

        \Phake::verify($categoryMock)->getAll();
    }

    public function testDelete() {
        $categoryMock = \Phake::mock('myfinance\repositories\CategoryRepository');
        $controller = new CategoryController($categoryMock);
        $id = 1;

        $controller->delete($id);

        \Phake::verify($categoryMock)->deleteById($id);
    }

    public function testPut() {
        $categoryMock = \Phake::mock('myfinance\repositories\CategoryRepository');
        $controller = new CategoryController($categoryMock);
        $json = '{"id":"1","type":"1","description":"Krankenkasse","budgetaryItem":"2"}';

        $controller->put(json_decode($json));

        \Phake::verify($categoryMock)->update(\Phake::ignoreRemaining());
    }

    public function testPost() {
        $categoryMock = \Phake::mock('myfinance\repositories\CategoryRepository');
        $controller = new CategoryController($categoryMock);
        $json = '{"type":"1","description":"Bargeldbezug","budgetaryItem":"2"}';

        $controller->post(json_decode($json));

        \Phake::verify($categoryMock)->create(\Phake::ignoreRemaining());
    }


}
