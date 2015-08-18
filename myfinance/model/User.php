<?php

namespace myfinance\model;

class User {

    public $id;
    public $name;
    public $password;

    public function setIdByName() {
        if ($this->name == 'user1') {
            $this->id = 1;
        } elseif ($this->name == 'user2') {
            $this->id = 2;
        } else {
            $this->id = 0;
        }
    }

}
