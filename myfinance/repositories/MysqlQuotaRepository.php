<?php

namespace myfinance\repositories;

class MysqlQuotaRepository implements QuotaRepository {

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
     * @param \myfinance\model\Quota $quota
     * @return \myfinance\model\Quota
     * @throws \Exception
     */
    public function create(\myfinance\model\Quota $quota) {
        $sql = "INSERT INTO quotas " .
                "(value, " .
                "month, " .
                "year, " .
                "budgetaryitem, " .
                "user) " .
                "VALUES ('" . $this->db->escape_string($quota->value) . "'," .
                "'" . $this->db->escape_string($quota->monthNumber) . "'," .
                "'" . $this->db->escape_string($quota->yearNumber) . "'," .
                "'" . $this->db->escape_string($quota->budgetaryItem) . "'," .
                "'" . $this->userId . "');";
        if (!$this->db->query($sql)) {
            throw new \Exception("Quota konnte nicht in DB erstellt werden: " . $this->db->error());
        }
        return $this->get($this->db->insert_id());
    }

    /**
     * 
     * @param \myfinance\model\Quota $quota
     * @throws \Exception
     */
    public function delete(\myfinance\model\Quota $quota) {
        $this->deleteById($quota->id);
    }

    /**
     * 
     * @param int $id
     * @throws \Exception
     */
    public function deleteById($id) {
        $sql = "DELETE FROM quotas WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("Quota konnte in DB nicht gelöscht werden: " . $this->db->error());
        }
    }

    /**
     * 
     * @param int $id
     * @return \myfinance\model\Quota
     */
    public function get($id) {
        $sql = "SELECT id,value,month,year,budgetaryitem FROM quotas " .
                "WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_assoc($res);
        return $this->createQuotaFromRow($row);
    }

    private function createQuotaFromRow($row) {
        $quota = new \myfinance\model\Quota();
        $quota->id = $row['id'];
        $quota->value = $row['value'];
        $quota->monthNumber = $row['month'];
        $quota->yearNumber = $row['year'];
        $quota->budgetaryItem = $row['budgetaryitem'];

        return $quota;
    }

    /**
     * 
     * @return array with Items of Type \myfinance\model\Quota
     */
    public function getAll() {
        $quotas = array();

        $sql = "SELECT id,value,month,year,budgetaryitem FROM quotas " .
                "WHERE user='" . $this->userId . "';";
        $res = $this->db->query($sql);
        while ($row = $this->db->fetch_assoc($res)) {
            $quotas[] = $this->createQuotaFromRow($row);
        }

        return $quotas;
    }

    /**
     * 
     * @param \myfinance\model\BudgetaryItem $quota
     * @return \myfinance\model\BudgetaryItem
     * @throws \Exception
     */
    public function update(\myfinance\model\Quota $quota) {
        $sql = "UPDATE quotas SET " .
                "value = '" . $this->db->escape_string($quota->value) . "', " .
                "month = '" . $this->db->escape_string($quota->monthNumber) . "', " .
                "year = '" . $this->db->escape_string($quota->yearNumber) . "', " .
                "budgetaryitem = '" . $this->db->escape_string($quota->budgetaryItem) . "' " .
                "WHERE id='" . intval($quota->id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("Quota konnte in DB nicht aktualisiert werden: " . $this->db->error());
        }
        return $this->get($quota->id);
    }

}
