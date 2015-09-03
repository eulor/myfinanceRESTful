<?php

namespace myfinance\repositories;

class MysqlCategoryRepository implements CategoryRepository {

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
     * @param \myfinance\model\Category $category
     * @return \myfinance\model\Category
     * @throws \Exception
     */
    public function create(\myfinance\model\Category $category) {
        $sql = "INSERT INTO categories " .
                "(type, " .
                "description, " .
                "budgetaryitem, " .
                "user) " .
                "VALUES ('" . $this->db->escape_string($category->type) . "'," .
                "'" . $this->db->escape_string($category->description) . "'," .
                "'" . $this->db->escape_string($category->budgetaryItem) . "'," .
                "'" . $this->userId . "');";
        if (!$this->db->query($sql)) {
            throw new \Exception("Category konnte nicht in DB erstellt werden: " . $this->db->error());
        }
        return $this->get($this->db->insert_id());
    }

    /**
     * 
     * @param \myfinance\model\Category $category
     * @throws \Exception
     */
    public function delete(\myfinance\model\Category $category) {
        $this->deleteById($category->id);
    }

    /**
     * 
     * @param int $id
     * @throws \Exception
     */
    public function deleteById($id) {
        $sql = "DELETE FROM categories WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("Category konnte in DB nicht gelöscht werden: " . $this->db->error());
        }
    }

    /**
     * 
     * @param int $id
     * @return \myfinance\model\Category
     */
    public function get($id) {
        $sql = "SELECT id,type,description,budgetaryitem FROM categories " .
                "WHERE id='" . intval($id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_assoc($res);
        return $this->createCategoryFromRow($row);
    }

    private function createCategoryFromRow($row) {
        $category = new \myfinance\model\Category();
        $category->id = $row['id'];
        $category->type = $row['type'];
        $category->description = $row['description'];
        $category->budgetaryItem = $row['budgetaryitem'];

        return $category;
    }

    /**
     * 
     * @return array with Items of Type \myfinance\model\Category
     */
    public function getAll() {
        $categories = array();

        $sql = "SELECT id,type,description,budgetaryitem FROM categories " .
                "WHERE user='" . $this->userId . "';";
        $res = $this->db->query($sql);
        while ($row = $this->db->fetch_assoc($res)) {
            $categories[] = $this->createCategoryFromRow($row);
        }

        return $categories;
    }

    /**
     * 
     * @param \myfinance\model\Category $category
     * @return \myfinance\model\Category
     * @throws \Exception
     */
    public function update(\myfinance\model\Category $category) {
        $sql = "UPDATE categories SET " .
                "type = '" . $this->db->escape_string($category->type) . "', " .
                "description = '" . $this->db->escape_string($category->description) . "', " .
                "budgetaryitem = '" . $this->db->escape_string($category->budgetaryItem) . "' " .
                "WHERE id='" . intval($category->id) . "' AND user='" . $this->userId . "' LIMIT 1;";
        if (!$this->db->query($sql)) {
            throw new \Exception("Category konnte in DB nicht aktualisiert werden: " . $this->db->error());
        }
        return $this->get($category->id);
    }

}
