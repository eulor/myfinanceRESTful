<?php

namespace myfinance\repositories;

class DummyAccountingEntryRepository implements AccountingEntryRepository {

    private $context;

    public function __construct(\myfinance\FinanceContext $context) {
        $this->context = $context;
    }

    public function create(\myfinance\model\AccountingEntry $accountingEntry) {
        
    }

    public function delete(\myfinance\model\AccountingEntry $accountingEntry) {
        
    }

    public function deleteById($id) {
        
    }

    public function get($id) {
        
    }

    public function getAll() {
        
    }

    public function update(\myfinance\model\AccountingEntry $accountingEntry) {
        
    }

}
