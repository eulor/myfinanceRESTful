<?php

namespace myfinance\repositories;

interface QuotaRepository {

    public function get($id);

    public function getAll();

    public function update(\myfinance\model\Quota $quota);

    public function create(\myfinance\model\Quota $quota);

    public function delete(\myfinance\model\Quota $quota);

    public function deleteById($id);
}
