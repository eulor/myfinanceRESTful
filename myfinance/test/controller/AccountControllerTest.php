<?php

namespace myfinance\test\controller;

use myfinance\controller\AccountController;

class AccountControllerTest extends \PHPUnit_Framework_TestCase {

    public function testGetOneAccount() {
        $accountRepoMock = \Phake::mock('myfinance\repositories\AccountRepository');
        $controller = new AccountController($accountRepoMock);
        $id = 1;

        $controller->get($id);

        \Phake::verify($accountRepoMock)->get($id);
    }

    public function testGetAllAccounts() {
        $accountRepoMock = \Phake::mock('myfinance\repositories\AccountRepository');
        $controller = new AccountController($accountRepoMock);

        $controller->get();

        \Phake::verify($accountRepoMock)->getAll();
    }

    public function testDelete() {
        $accountRepoMock = \Phake::mock('myfinance\repositories\AccountRepository');
        $controller = new AccountController($accountRepoMock);
        $id = 1;

        $controller->delete($id);

        \Phake::verify($accountRepoMock)->deleteById($id);
    }

    public function testPut() {
        $accountRepoMock = \Phake::mock('myfinance\repositories\AccountRepository');
        $controller = new AccountController($accountRepoMock);
        $json = '{"id":"21","description":"LUKB nochmals von User1","saldo":"0.00"}';

        $controller->put(json_decode($json));

        \Phake::verify($accountRepoMock)->update(\Phake::ignoreRemaining());
    }

    public function testPost() {
        $accountRepoMock = \Phake::mock('myfinance\repositories\AccountRepository');
        $controller = new AccountController($accountRepoMock);
        $json = '{"description":"LUKB von User1","saldo":"0.00"}';

        $controller->post(json_decode($json));

        \Phake::verify($accountRepoMock)->create(\Phake::ignoreRemaining());
    }

}
