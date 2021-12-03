<?php

class Database
{

    public $_conn;
    public function __construct(string $hostname, string $db_name, string $username, string $password)
    {
        try{
            $this->_conn = new \PDO('mysql:host=' . $hostname . ';db_name=' . $db_name . ';charset=utf8mb4', $username, $password, null);
        }catch(PDOException $e){
            throw new PDOException($e->getCode(), $e->getMessage());
        }
    }

    public function request(string $sql, array $options = null)
    {
        $request = $this->_conn->prepare($sql);
        $str = $request->execute($options);
        return $str;
    }

}



?>