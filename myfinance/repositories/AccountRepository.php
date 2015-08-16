<?php

namespace myfinance\repositories;

interface AccountRepository {

    public function get($id);

    public function getAll();

    public function update(\myfinance\model\Account $account);

    public function create(\myfinance\model\Account $account);

    public function delete(\myfinance\model\Account $account);

    public function deleteById($id);
}
