<?php

namespace myfinance\repositories;

class MysqlAccountRepository implements AccountRepository {

    private $db;
    private $userId;
    private $context;

    public function __construct(\myfinance\FinanceContext $context) {
        $this->context = $context;
        $this->userId = $context->getUser()->id;
        $this->db = $this->context->getDb();
        $this->db->connect();
    }

    public function get($id) {
        $sql = "SELECT * FROM accounts WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_assoc($res);
        return $this->createAccountFromRow($row);
    }

    private function createAccountFromRow($row) {
        $account = new \myfinance\model\Account();
        $account->id = $row['id'];
        $account->description = $row['description'];
        $account->saldo = $row['saldo'];
        $account->accountingEntries = array();

        return $account;
    }

    public function getAll() {
        $accounts = array();

        $sql = "SELECT * FROM accounts WHERE user='" . $this->userId . "';";
        $res = $this->db->query($sql);
        while ($row = $this->db->fetch_assoc($res)) {
            $accounts[] = $this->createAccountFromRow($row);
        }

        return $accounts;
    }

    public function update(\myfinance\model\Account $account) {
        
    }

    public function create(\myfinance\model\Account $account) {
        
    }

    public function delete(\myfinance\model\Account $account) {
        
    }

    public function deleteById($id) {
        
    }

}
