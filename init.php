<?php
session_start();
require_once dirname(__FILE__) . '/jdatetime.class.php';
class Init{

    public static function Db(){
        $conn = new mysqli(
            "localhost",
            "root",
            "123",
            "skajular"
        );
        if ($conn->connect_error) {
            die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
        }
        return $conn;
    }


}