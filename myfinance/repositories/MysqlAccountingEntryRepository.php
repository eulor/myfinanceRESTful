<?php

namespace myfinance\repositories;

class MysqlAccountingEntryRepository implements AccountingEntryRepository {

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
     * @return \myfinance\model\AccountingEntry
     */
    public function get($id) {
        $sql = "SELECT id,amount,description,date,account,category FROM accountingentries " .
                "WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_assoc($res);
        return $this->createAccountingEntryFromRow($row);
    }

    private function createAccountingEntryFromRow($row) {
        $accountingEntry = new \myfinance\model\AccountingEntry();
        $accountingEntry->id = $row['id'];
        $accountingEntry->amount = $row['amount'];
        $accountingEntry->description = $row['description'];
        $accountingEntry->date = $row['date'];
        $accountingEntry->account = $row['account'];
        $accountingEntry->category = $row['category'];

        return $accountingEntry;
    }

    /**
     * 
     * @return array with Items of Type \myfinance\model\AccountingEntry
     */
    public function getAll() {
        $accountingEntries = array();

        $sql = "SELECT id,amount,description,date,account,category FROM accountingentries " .
                "WHERE user='" . $this->userId . "';";
        $res = $this->db->query($sql);
        while ($row = $this->db->fetch_assoc($res)) {
            $accountingEntries[] = $this->createAccountingEntryFromRow($row);
        }

        return $accountingEntries;
    }

    /**
     * 
     * @param \myfinance\model\AccountingEntry $accountingEntry
     * @return \myfinance\model\AccountingEntry
     * @throws \Exception
     */
    public function update(\myfinance\model\AccountingEntry $accountingEntry) {
        $sql = "UPDATE accountingentries SET " .
                "amount = '" . $this->db->escape_string($accountingEntry->amount) . "', " .
                "description = '" . $this->db->escape_string($accountingEntry->description) . "', " .
                "date = '" . $this->db->escape_string($accountingEntry->date) . "', " .
                "account = '" . $this->db->escape_string($accountingEntry->account) . "', " .
                "category = '" . $this->db->escape_string($accountingEntry->category) . "' " .
                "WHERE id='" . intval($accountingEntry->id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("AccountingEntry konnte in DB nicht aktualisiert werden: " . $this->db->error());
        }
        return $this->get($accountingEntry->id);
    }

    /**
     * 
     * @param \myfinance\model\AccountingEntry $accountingEntry
     * @return \myfinance\model\AccountingEntry
     * @throws \Exception
     */
    public function create(\myfinance\model\AccountingEntry $accountingEntry) {
        $sql = "INSERT INTO accountingentries " .
                "(amount, " .
                "description, " .
                "date, " .
                "account, " .
                "category, " .
                "user) " .
                "VALUES ('" . $this->db->escape_string($accountingEntry->amount) . "'," .
                "'" . $this->db->escape_string($accountingEntry->description) . "'," .
                "'" . $this->db->escape_string($accountingEntry->date) . "'," .
                "'" . $this->db->escape_string($accountingEntry->account) . "'," .
                "'" . $this->db->escape_string($accountingEntry->category) . "'," .
                "'" . $this->userId . "');";
        if (!$this->db->query($sql)) {
            throw new \Exception("AccountingEntry konnte nicht in DB erstellt werden: " . $this->db->error());
        }
        return $this->get($this->db->insert_id());
    }

    /**
     * 
     * @param \myfinance\model\AccountingEntry $accountingEntry
     * @throws \Exception
     */
    public function delete(\myfinance\model\AccountingEntry $accountingEntry) {
        $this->deleteById($accountingEntry->id);
    }

    /**
     * 
     * @param int $id
     * @throws \Exception
     */
    public function deleteById($id) {
        $sql = "DELETE FROM accountingentries WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("AccountingEntry konnte in DB nicht gelöscht werden: " . $this->db->error());
        }
    }

}
