<?php

namespace myfinance\repositories;

class MysqlBudgetaryItemRepository implements BudgetaryItemRepository {

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
     * @param \myfinance\model\BudgetaryItem $budgetaryItem
     * @return \myfinance\model\BudgetaryItem
     * @throws \Exception
     */
    public function create(\myfinance\model\BudgetaryItem $budgetaryItem) {
        $sql = "INSERT INTO budgetaryitems " .
                "(description, " .
                "user) " .
                "VALUES ('" . $this->db->escape_string($budgetaryItem->description) . "'," .
                "'" . $this->userId . "');";
        if (!$this->db->query($sql)) {
            throw new \Exception("BudgetaryItem konnte nicht in DB erstellt werden: " . $this->db->error());
        }
        return $this->get($this->db->insert_id());
    }

    /**
     * 
     * @param \myfinance\model\BudgetaryItem $budgetaryItem
     * @throws \Exception
     */
    public function delete(\myfinance\model\BudgetaryItem $budgetaryItem) {
        $this->deleteById($budgetaryItem->id);
    }

    /**
     * 
     * @param int $id
     * @throws \Exception
     */
    public function deleteById($id) {
        $sql = "DELETE FROM budgetaryitems WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("BudgetaryItem konnte in DB nicht gelöscht werden: " . $this->db->error());
        }
    }

    /**
     * 
     * @param int $id
     * @return \myfinance\model\BudgetaryItem
     */
    public function get($id) {
        $sql = "SELECT id,description FROM budgetaryitems " .
                "WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_assoc($res);
        return $this->createBudgetaryItemFromRow($row);
    }

    private function createBudgetaryItemFromRow($row) {
        $budgetaryItem = new \myfinance\model\BudgetaryItem();
        $budgetaryItem->id = $row['id'];
        $budgetaryItem->description = $row['description'];

        return $budgetaryItem;
    }

    /**
     * 
     * @return array with Items of Type \myfinance\model\BudgetaryItems
     */
    public function getAll() {
        $budgetaryItems = array();

        $sql = "SELECT id,description FROM budgetaryitems " .
                "WHERE user='" . $this->userId . "';";
        $res = $this->db->query($sql);
        while ($row = $this->db->fetch_assoc($res)) {
            $budgetaryItems[] = $this->createBudgetaryItemFromRow($row);
        }

        return $budgetaryItems;
    }

    /**
     * 
     * @param \myfinance\model\BudgetaryItem $budgetaryItem
     * @return \myfinance\model\BudgetaryItem
     * @throws \Exception
     */
    public function update(\myfinance\model\BudgetaryItem $budgetaryItem) {
        $sql = "UPDATE budgetaryitems SET " .
                "description = '" . $this->db->escape_string($budgetaryItem->description) . "', " .
                "WHERE id='" . intval($budgetaryItem->id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("BudgetaryItem konnte in DB nicht aktualisiert werden: " . $this->db->error());
        }
        return $this->get($budgetaryItem->id);
    }

}
