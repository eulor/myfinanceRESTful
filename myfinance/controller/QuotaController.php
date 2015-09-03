<?php

namespace myfinance\controller;

use myfinance\repositories\QuotaRepository;

class QuotaController {

    private $repository;

    public function __construct(QuotaRepository $repository) {
        $this->repository = $repository;
    }

    public function get($id = null) {
        $quotas = array();
        if (is_null($id)) {
            $quotas = $this->repository->getAll();
        } else {
            $quotas[] = $this->repository->get($id);
        }

        return json_encode($quotas);
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
     * @return \myfinance\model\Quota
     */
    public function put($input) {
        $quota = $this->createNewQuotaFromInput($input);
        return $this->repository->update($quota);
    }

    /**
     * 
     * @param Object $input
     * @return \myfinance\model\Quota
     */
    public function post($input) {
        $quota = $this->createNewQuotaFromInput($input);
        return $this->repository->create($quota);
    }

    private function createNewQuotaFromInput($input) {
        $quota = new \myfinance\model\Quota();
        if (isset($input->id)) {
            $quota->id = $input->id;
        }
        if (isset($input->value)) {
            $quota->value = $input->value;
        }
        if (isset($input->month)) {
            $quota->month = $input->month;
        }
        if (isset($input->year)) {
            $quota->year = $input->year;
        }
        if (isset($input->budgetaryItem)) {
            $quota->budgetaryItem = $input->budgetaryItem;
        }
        return $quota;
    }

}
