<?php
abstract class Connection
{

    private $servDB = 'mysql:host=127.0.0.1;dbname=estock';
    private $user = 'root';
    private $pass = '';

    protected function connect()
    {
        try {
            $conn = new PDO($this->servDB, $this->user, $this->pass);
            $conn->exec("set names utf8");
            return $conn;
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }
}