<?php

namespace myfinance\repositories;

interface AccountingEntryRepository {

    public function get($id);

    public function getAll();

    public function update(\myfinance\model\AccountingEntry $accountingEntry);

    public function create(\myfinance\model\AccountingEntry $accountingEntry);

    public function delete(\myfinance\model\AccountingEntry $accountingEntry);

    public function deleteById($id);
}
