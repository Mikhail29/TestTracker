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
    
    public function update($params)
    {
        
    }
    
    public function find($offset = 0, $limit = 10, $order=null)
    {
        $table_name = substr(strrchr(get_class($this), "\\"), 1);
        $table_name = strtolower(str_replace("Model", "", $table_name));
        $query = "SELECT * FROM {$table_name}";
        if(!empty($conditions))
        {
            $query .= "";
        }
        if(!is_null($order))
        {
            $query .= " ORDER BY '{$order}'";
        }
        $query .= " LIMIT {$offset},{$limit}";
        $queryDB = $this->connection->prepare($query);
        $success = $queryDB->execute();
        if($success === false)
        {
            return false;
        }
        return $queryDB->fetchAll(\PDO::FETCH_CLASS);
    }
    
    public function findFirst($conditions)
    {
        return false;
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