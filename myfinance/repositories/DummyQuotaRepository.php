<?php

namespace myfinance\repositories;

class DummyQuotaRepository implements QuotaRepository {

    private $context;

    public function __construct(\myfinance\FinanceContext $context) {
        $this->context = $context;
    }

    public function create(\myfinance\model\Quota $quota) {
        
    }

    public function delete(\myfinance\model\Quota $quota) {
        
    }

    public function deleteById($id) {
        
    }

    public function get($id) {
        
    }

    public function getAll() {
        
    }

    public function update(\myfinance\model\Quota $quota) {
        
    }

}
