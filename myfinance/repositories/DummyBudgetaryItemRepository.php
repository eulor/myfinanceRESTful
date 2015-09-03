<?php

namespace myfinance\repositories;

class DummyBudgetaryItemRepository implements BudgetaryItemRepository {

    private $context;

    public function __construct(\myfinance\FinanceContext $context) {
        $this->context = $context;
    }

    public function create(\myfinance\model\BudgetaryItem $budgetaryItem) {
        
    }

    public function delete(\myfinance\model\BudgetaryItem $budgetaryItem) {
        
    }

    public function deleteById($id) {
        
    }

    public function get($id) {
        
    }

    public function getAll() {
        
    }

    public function update(\myfinance\model\BudgetaryItem $budgetaryItem) {
        
    }

}
