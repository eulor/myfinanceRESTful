<?php

namespace myfinance\db;

interface DB {

    public function connect();

    public function error();

    public function escape_string($string);

    public function query($query);
    
    public function insert_id();

    public function fetch_assoc($result);

    public function close();
}
