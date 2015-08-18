<?php

namespace myfinance\db;

class DummyDB implements DB {

    private $rows = array(
        array('id' => 1,
            'description' => 'Item 1',
        ),
        array('id' => 2,
            'description' => 'Item 2',
        ),
        array('id' => 3,
            'description' => 'Item 3',
        ),
    );
    private $counter = 0;

    public function connect() {
        return true;
    }

    public function error() {
        return "DummyDB Error: Unable to execute.";
    }

    public function escape_string($string) {
        return addcslashes($string, ';');
    }

    public function query($query) {
        return true;
    }
    
    public function insert_id(){
        return $this->counter;
    }

    public function fetch_assoc($result) {
        $item = false;
        if (key_exists($this->counter, $this->rows)) {
            $item = $this->rows[$this->counter];
            $this->counter++;
        }
        return $item;
    }

    public function close() {
        return true;
    }

}
