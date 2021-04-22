<?php

namespace APP\Core;

class BaseModel
{
    private $connection;
    
    function __construct()
    {
        $this->connection = new DB();
    }
    
    public function insert($data)
    {
        $table_name = substr(strrchr(get_class($this), "\\"), 1);
        $table_name = strtolower(str_replace("Model", "", $table_name));
        $query = "INSERT INTO {$table_name}";
        $keys = array_keys($data);
        $sqlKeys = implode(", ", $keys);
        $sqlData = array();
        foreach($keys as $key)
        {
            $data[$key] = htmlspecialchars($data[$key]);
            $sqlData[":".$key] = $data[$key];
        }
        $sqlPsevdoData = implode(", ", array_keys($sqlData));
        $query .= " ({$sqlKeys}) VALUES({$sqlPsevdoData})";
        $queryDB = $this->connection->prepare($query);
        return $queryDB->execute($data);
    }
    
    public function update($field = "id", $value = "0", $data)
    {
        $table_name = substr(strrchr(get_class($this), "\\"), 1);
        $table_name = strtolower(str_replace("Model", "", $table_name));
        $query = "UPDATE {$table_name} SET ";
        $keys = array_keys($data);
        $sqlData = "";
        foreach($keys as $key)
        {
            $data[$key] = htmlspecialchars($data[$key]);
            if(empty($sqlData))
            {
                $sqlData = "{$key}=:{$key}";
            }
            else
            {
                $sqlData .= ", {$key}=:{$key}";
            }
        }
        $query .= " ".$sqlData;
        $query .= " WHERE {$field} = {$value}";
        $queryDB = $this->connection->prepare($query);
        return $queryDB->execute($data);
    }
    
    public function getCount()
    {
        $table_name = substr(strrchr(get_class($this), "\\"), 1);
        $table_name = strtolower(str_replace("Model", "", $table_name));
        $query = "SELECT COUNT(*) as count FROM {$table_name}";
        $queryDB = $this->connection->prepare($query);
        $queryDB->execute();
        $dataCount = $queryDB->fetch();
        return $dataCount["count"];
    }
    
    public function find($offset = 0, $limit = 10, $orderBy="id", $orderType = "ASC")
    {
        $table_name = substr(strrchr(get_class($this), "\\"), 1);
        $table_name = strtolower(str_replace("Model", "", $table_name));
        $query = "SELECT * FROM {$table_name}";
        $query .= " ORDER BY {$orderBy} {$orderType}";
        $query .= " LIMIT {$offset},{$limit}";
        $queryDB = $this->connection->prepare($query);
        $success = $queryDB->execute();
        if($success === false)
        {
            return false;
        }
        return $queryDB->fetchAll(\PDO::FETCH_CLASS);
    }
    
    public function findFirst($field = "id", $value = "0")
    {
        $table_name = substr(strrchr(get_class($this), "\\"), 1);
        $table_name = strtolower(str_replace("Model", "", $table_name));
        $query = "SELECT * FROM {$table_name} WHERE {$field} = :{$field} LIMIT 1";
        $queryDB = $this->connection->prepare($query);
        $data[$field] = $value;
        $success = $queryDB->execute($data);
        if($success === false)
        {
            return false;
        }
        return $queryDB->fetch();
    }
    
    public function delete($field="id", $value="0")
    {
        $table_name = substr(strrchr(get_class($this), "\\"), 1);
        $table_name = strtolower(str_replace("Model", "", $table_name));
        $query = "DELETE FROM {$table_name} WHERE {$field} = :{$field}";
        $queryDB = $this->connection->prepare($query);
        $data[$field] = $value;
        return $queryDB->execute($data);
    }
}