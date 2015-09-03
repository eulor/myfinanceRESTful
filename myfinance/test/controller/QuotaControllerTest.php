<?php

namespace myfinance\test\controller;

use myfinance\controller\QuotaController;

class QuotaControllerTest extends \PHPUnit_Framework_TestCase {

    public function testGetOneQuota() {
        $quotaMock = \Phake::mock('myfinance\repositories\QuotaRepository');
        $controller = new QuotaController($quotaMock);
        $id = 1;

        $controller->get($id);

        \Phake::verify($quotaMock)->get($id);
    }

    public function testGetAllQuotas() {
        $quotaMock = \Phake::mock('myfinance\repositories\QuotaRepository');
        $controller = new QuotaController($quotaMock);

        $controller->get();

        \Phake::verify($quotaMock)->getAll();
    }

    public function testDelete() {
        $quotaMock = \Phake::mock('myfinance\repositories\QuotaRepository');
        $controller = new QuotaController($quotaMock);
        $id = 1;

        $controller->delete($id);

        \Phake::verify($quotaMock)->deleteById($id);
    }

    public function testPut() {
        $quotaMock = \Phake::mock('myfinance\repositories\QuotaRepository');
        $controller = new QuotaController($quotaMock);
        $json = '{"id":"1","value":"10000","monthNumber":"3","yearNumber":"2015","budgetaryItem":"2"}';

        $controller->put(json_decode($json));

        \Phake::verify($quotaMock)->update(\Phake::ignoreRemaining());
    }

    public function testPost() {
        $quotaMock = \Phake::mock('myfinance\repositories\QuotaRepository');
        $controller = new QuotaController($quotaMock);
        $json = '{"value":"10000","monthNumber":"3","yearNumber":"2015","budgetaryItem":"2"}';

        $controller->post(json_decode($json));

        \Phake::verify($quotaMock)->create(\Phake::ignoreRemaining());
    }

}
