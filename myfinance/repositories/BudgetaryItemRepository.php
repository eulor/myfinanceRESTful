<?php

namespace myfinance\repositories;

interface BudgetaryItemRepository {

    public function get($id);

    public function getAll();

    public function update(\myfinance\model\BudgetaryItem $budgetaryItem);

    public function create(\myfinance\model\BudgetaryItem $budgetaryItem);

    public function delete(\myfinance\model\BudgetaryItem $budgetaryItem);

    public function deleteById($id);
}
