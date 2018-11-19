<?php

class DbHelper{
    static function QueryToArray($query){
        $res = array();
        while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
            array_push($res, $row);
        }
        return $res;
    }
}