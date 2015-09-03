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

    /**
     * 
     * @param int $id
     */
    public function delete($id) {
        $this->repository->deleteById($id);
    }

    /**
     * 
     * @param Object $input
     * @return \myfinance\model\Account
     */
    public function put($input) {
        $account = $this->createNewAccountInstanceFromInput($input);
        return $this->repository->update($account);
    }

    /**
     * 
     * @param Object $input
     * @return \myfinance\model\Account
     */
    public function post($input) {
        $account = $this->createNewAccountInstanceFromInput($input);
        return $this->repository->create($account);
    }

    private function createNewAccountInstanceFromInput($input) {
        $account = new \myfinance\model\Account();
        if (isset($input->id)) {
            $account->id = $input->id;
        }
        if (isset($input->description)) {
            $account->description = $input->description;
        }
        if (isset($input->saldo)) {
            $account->saldo = $input->saldo;
        }
        return $account;
    }

}
