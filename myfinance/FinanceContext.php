<?php

namespace myfinance;

class FinanceContext {

    private $db;
    private $user;

    public function __construct($db, $user) {
        $this->db = $db;
        $this->user = $user;
    }

    public function getDb() {
        return $this->db;
    }

    public function getUser() {
        return $this->user;
    }

}
