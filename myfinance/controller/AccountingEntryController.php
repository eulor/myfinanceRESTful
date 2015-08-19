<?php

namespace myfinance\controller;

use myfinance\repositories\AccountingEntryRepository;

class AccountingEntryController {

    private $repository;

    public function __construct(AccountingEntryRepository $repository) {
        $this->repository = $repository;
    }

    public function get($id = null) {
        $accountingEntries = array();
        if (is_null($id)) {
            $accountingEntries = $this->repository->getAll();
        } else {
            $accountingEntries[] = $this->repository->get($id);
        }

        return json_encode($accountingEntries);
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
     * @return \myfinance\model\AccountingEntry
     */
    public function put($input) {
        $accountingEntry = $this->createNewAccountingEntryInstanceFromInput($input);
        return $this->repository->update($accountingEntry);
    }

    /**
     * 
     * @param Object $input
     * @return \myfinance\model\AccountingEntry
     */
    public function post($input) {
        $accountingEntry = $this->createNewAccountingEntryInstanceFromInput($input);
        return $this->repository->create($accountingEntry);
    }

    private function createNewAccountingEntryInstanceFromInput($input) {
        $accountingEntry = new \myfinance\model\AccountingEntry();
        if (isset($input->id)) {
            $accountingEntry->id = $input->id;
        }
        if (isset($input->amount)) {
            $accountingEntry->amount = $input->amount;
        }
        if (isset($input->description)) {
            $accountingEntry->description = $input->description;
        }
        if (isset($input->date)) {
            $accountingEntry->date = $input->date;
        }
        if (isset($input->account)) {
            $accountingEntry->account = $input->account;
        }
        if (isset($input->category)) {
            $accountingEntry->category = $input->category;
        }
        return $accountingEntry;
    }

}
