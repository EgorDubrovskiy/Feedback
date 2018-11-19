<?php
require_once 'Connect.php';
require_once 'DbHelper.php';
require_once 'AdminController.php';

class MessageController extends Connect{
    static function get($SortColumnName = "date"){
        parent::open();
        $sql = "SELECT * FROM Messages";
        switch($SortColumnName){
            case "date": $sql .= " ORDER BY date DESC"; break;
            case "email": $sql .= " ORDER BY email DESC"; break;
            case "name": $sql .= " ORDER BY name DESC"; break;
        }
        $query = sqlsrv_query(self::$conn, $sql);
        $res = DbHelper::QueryToArray($query);

        parent::close();
        return $res;
    }

    static function add(string $name, string $email, string $text, $photo){
        parent::open();
        $query = sqlsrv_query(self::$conn, 'EXEC AddMessage ?, ?, ?, ?', array($name, $email, $text, $photo['name']));
        //сохраняем аватарку на сервер
        move_uploaded_file($photo['tmp_name'], '../ImgMess/'.$photo['name']);
        parent::close();
    }

    static function delete(int $id){
        if(AdminController::isAuth() == false)
        {
            header('http://'.$_SERVER['DOCUMENT_ROOT'].'/auth/signin');
        }

        parent::open();

        $query = sqlsrv_query(self::$conn, 'EXEC DeleteMessage ?', array($id));

        parent::close();
    }
}