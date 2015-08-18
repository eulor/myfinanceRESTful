<?php

namespace myfinance\repositories;

class DummyAccountRepository implements AccountRepository {
    private $context;
    
    public function __construct(\myfinance\FinanceContext $context) {
        $this->context = $context;
    }

    public function create(\myfinance\model\Account $account) {
        
    }

    public function delete(\myfinance\model\Account $account) {
        
    }

    public function deleteById($id) {
        
    }

    public function get($id) {
        
    }

    public function getAll() {
        
    }

    public function update(\myfinance\model\Account $account) {
        
    }

}
