<?php
include $_SERVER['DOCUMENT_ROOT'].'/config.php';

class Connect{
    static $conn;
    static $connInfo = array( "Database"=> DbName, "CharacterSet" => "UTF-8");

    protected static function open(){
        self::$conn = sqlsrv_connect(ServerName, self::$connInfo);
    }
    
    protected static function close(){
        sqlsrv_close(self::$conn);
    }
}