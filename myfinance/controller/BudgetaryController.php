<?php

namespace myfinance\controller;

use myfinance\repositories\BudgetaryItemRepository;

class BudgetaryController {

    private $repository;

    public function __construct(BudgetaryItemRepository $repository) {
        $this->repository = $repository;
    }

    public function get($id = null) {
        $budgetaryItems = array();
        if (is_null($id)) {
            $budgetaryItems = $this->repository->getAll();
        } else {
            $budgetaryItems[] = $this->repository->get($id);
        }

        return json_encode($budgetaryItems);
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
     * @return \myfinance\model\BudgetaryItem
     */
    public function put($input) {
        $budgetaryItem = $this->createNewBudgetaryItemFromInput($input);
        return $this->repository->update($budgetaryItem);
    }

    /**
     * 
     * @param Object $input
     * @return \myfinance\model\BudgetaryItem
     */
    public function post($input) {
        $budgetaryItem = $this->createNewBudgetaryItemFromInput($input);
        return $this->repository->create($budgetaryItem);
    }

    private function createNewBudgetaryItemFromInput($input) {
        $budgetaryItem = new \myfinance\model\BudgetaryItem();
        if (isset($input->id)) {
            $budgetaryItem->id = $input->id;
        }
        if (isset($input->description)) {
            $budgetaryItem->description = $input->description;
        }
        return $budgetaryItem;
    }

}
