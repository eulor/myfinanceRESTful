<?php

namespace myfinance\repositories;

class DummyCategoryRepository implements CategoryRepository {

    private $context;

    public function __construct(\myfinance\FinanceContext $context) {
        $this->context = $context;
    }

    public function create(\myfinance\model\Category $category) {
        
    }

    public function delete(\myfinance\model\Category $category) {
        
    }

    public function deleteById($id) {
        
    }

    public function get($id) {
        
    }

    public function getAll() {
        
    }

    public function update(\myfinance\model\Category $category) {
        
    }

}
