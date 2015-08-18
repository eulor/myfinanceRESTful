<?php
namespace myfinance\test\db;
use myfinance\db\DummyDB;

class DummyDBTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $dataBase = new DummyDB();
        
        $connection = $dataBase->connect();
        
        $this->assertEquals(true,$connection);
    }

    public function testError()
    {
        $dataBase = new DummyDB();
        
        $error = $dataBase->error();
        
        $this->assertTrue(is_string($error));
    }

    public function testEscape_string()
    {
        $dataBase = new DummyDB();
        $expResult = "\;DELETE";
        
        $result = $dataBase->escape_string(";DELETE");
        
        $this->assertEquals($expResult,$result);
    }

    public function testQuery()
    {
        $dataBase = new DummyDB();
        
        $result = $dataBase->query("some query");
        
        $this->assertTrue($result);
    }

    public function testFetch_assoc()
    {
        $dataBase = new DummyDB();
        
        $row = $dataBase->fetch_assoc("some result");
        
        $this->assertTrue(is_array($row));
    }

    public function testClose()
    {
        $dataBase = new DummyDB();
        
        $result = $dataBase->close();
        
        $this->assertTrue($result);
    }
}
