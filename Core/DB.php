<?php

namespace APP\Core;

class DB
{
    private $connection;
    
    function __construct()
    {
        $config = Config::getConfig();
        
        $dsn = "mysql:dbname={$config->dbName};host={$config->dbHost}";
        $user = $config->dbUserName;
        $password = $config->dbUserPassword;
        
        $dbh;
        try 
        {
            $this->connection = new \PDO($dsn, $user, $password);
        }
        catch(\Exception $e )
        {
            die($e->getMessage());
        }
    }
    
    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }
    
    public function query($sql, $params)
    {
        $query = $this->connection->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
        $query->bindParam(':name', $name);
        $query->bindParam(':value', $value);
    }
}