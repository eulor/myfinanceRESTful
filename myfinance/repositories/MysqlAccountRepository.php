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

    /**
     * 
     * @param int $id
     * @return \myfinance\model\Account
     */
    public function get($id) {
        $sql = "SELECT id,description,saldo FROM accounts " .
                "WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
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

    /**
     * 
     * @return array with Items of Type \myfinance\model\Account
     */
    public function getAll() {
        $accounts = array();

        $sql = "SELECT id,description,saldo FROM accounts WHERE user='" . $this->userId . "';";
        $res = $this->db->query($sql);
        while ($row = $this->db->fetch_assoc($res)) {
            $accounts[] = $this->createAccountFromRow($row);
        }

        return $accounts;
    }

    /**
     * 
     * @param \myfinance\model\Account $account
     * @return \myfinance\model\Account
     * @throws \Exception
     */
    public function update(\myfinance\model\Account $account) {
        $sql = "UPDATE accounts SET " .
                "description = '" . $this->db->escape_string($account->description) . "', " .
                "saldo = '" . $this->db->escape_string($account->saldo) . "' " .
                "WHERE id='" . intval($account->id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("Account konnte in DB nicht aktualisiert werden: " . $this->db->error());
        }
        return $this->get($account->id);
    }

    /**
     * 
     * @param \myfinance\model\Account $account
     * @return \myfinance\model\Account
     * @throws \Exception
     */
    public function create(\myfinance\model\Account $account) {
        $sql = "INSERT INTO accounts " .
                "(description, " .
                "saldo, " .
                "user) " .
                "VALUES ('" . $this->db->escape_string($account->description) . "'," .
                "'" . $this->db->escape_string($account->saldo) . "'," .
                "'" . $this->userId . "');";
        if (!$this->db->query($sql)) {
            throw new \Exception("Account konnte nicht in DB erstellt werden: " . $this->db->error());
        }
        return $this->get($this->db->insert_id());
    }

    /**
     * 
     * @param \myfinance\model\Account $account
     * @throws \Exception
     */
    public function delete(\myfinance\model\Account $account) {
        $this->deleteById($account->id);
    }

    /**
     * 
     * @param int $id
     * @throws \Exception
     */
    public function deleteById($id) {
        $sql = "DELETE FROM accounts WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("Account konnte in DB nicht gelöscht werden: " . $this->db->error());
        }
    }

}
