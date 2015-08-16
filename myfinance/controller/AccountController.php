<?php

namespace myfinance\controller;

use myfinance\repositories\AccountRepository;

class AccountController {

    private $repository;

    public function __construct(AccountRepository $repository) {
        $this->repository = $repository;
    }

    public function get($id = null) {
        $accounts = array();
        if (is_null($id)) {
            $accounts = $this->repository->getAll();
        } else {
            $accounts[] = $this->repository->get($id);
        }

        return json_encode($accounts);
    }

    public function delete($id) {
        
    }

    public function put($id) {
        
    }

    public function post($id) {
        
    }

}
