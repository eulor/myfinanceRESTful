<?php

namespace myfinance;

class FinanceContext {

    private $db;
    private $user;

    public function __construct($db, $user) {
        $this->db = $db;
        $this->user = $user;
    }

    /**
     * 
     * @return \myfinance\db\DB
     */
    public function getDb() {
        return $this->db;
    }

    /**
     * 
     * @return \myfinance\model\User
     */
    public function getUser() {
        return $this->user;
    }

}
