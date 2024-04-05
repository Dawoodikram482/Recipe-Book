<?php

namespace repositories;

use PDO;
use PDOException;

class repository
{
    protected PDO $database;
    public function __construct()
    {
        require __DIR__. '/../config/dbconfig.php';
        try{
            $this->database = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}