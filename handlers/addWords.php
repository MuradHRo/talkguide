<?php
class addWords{
    private $connection;
    private $tableName;
    public function __construct($connection,$tableName){
        $this->connection = $connection;
        $this->tableName = $tableName;
    }
    public function AddToDataBase($word,$email,$notes){
        $this->connection->query("INSERT INTO words_to_add VALUES (NULL,'$word','$email','$notes','$this->tableName','no')");
    }
}

?>