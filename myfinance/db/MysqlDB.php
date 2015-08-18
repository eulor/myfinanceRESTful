<?php

namespace myfinance\db;

class MysqlDB implements DB {

    private $connection;
    private $server;
    private $username;
    private $password;
    private $database;

    public function __construct($server, $username, $password, $database) {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect() {
        $this->connection = new \mysqli($this->server, $this->username, $this->password, $this->database);
    }

    public function error() {
        return $this->connection->error;
    }

    public function escape_string($string) {
        return $this->connection->real_escape_string($string);
    }

    /**
     * 
     * @param string $query
     * @return boolean OR mysqli_result for successful SELECT, SHOW, DESCRIBE or EXPLAIN
     */
    public function query($query) {
        return $this->connection->query($query);
    }
    
    public function insert_id() {
        return $this->connection->insert_id;
    }

    /**
     * 
     * @param mysqli_result $result
     * @return array associative of strings representing the fetched row OR NULL
     */
    public function fetch_assoc($result) {
        $row = false;
        if (is_a($result, \mysqli_result::class)) {
            $row = $result->fetch_assoc();
        }
        return $row;
    }

    /**
     * 
     * @return boolean
     */
    public function close() {
        return $this->connection->close();
    }

}
