<?php

namespace config;

use PDO;
use PDOException;

class Database
{
    private PDO $conn;
    public function __construct($host,$user,$password,$dbname)
    {
        try {
            $this->conn=new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getConn(): ?PDO
    {
        return $this->conn;
    }
}