<?php
session_start();
require_once 'Connect.php';
include $_SERVER['DOCUMENT_ROOT'].'/config.php';

class AdminController extends Connect{
    static function signin(string $login, string $password){

        //блок инициализации
        $Res = array();
        $login = trim($login);
        $password = trim($password);

        //блок валидации
        parent::open();
        $query = sqlsrv_query(self::$conn, 'SELECT id FROM Admins WHERE login = ?', array($login));
        $rows = sqlsrv_has_rows($query);
        if($rows === false)
        {
            $Res['login'] = "Пользователь с данным логином не существует";
        }
        else{
            $query = sqlsrv_query(self::$conn, 'SELECT id FROM Admins WHERE login = ? AND password = ?', array($login, md5($password.salt)));
            $rows = sqlsrv_has_rows($query);
            if($rows === false)
            {
                $Res['password'] = "Неверный пароль";
            }
        }
        parent::close();

        //блок авторизации
        if(empty($Res))
        {
            $_SESSION['AdminLogin'] = $login;
        }

        return json_encode($Res);
    }

    static function isAuth():bool{
        if(isset($_SESSION['AdminLogin'])) return true;
        return false;
    }
}