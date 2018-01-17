<?php
/**
 * Created by PhpStorm.
 * User: JINCHURIKI
 * Date: 1/6/2018
 * Time: 02:37
 */


/*require_once "../../api/model/app-function.php";*/
require_once "db-connect.php";

function getCount($table){
    $count = 0;

    $query = mysqli_query($GLOBALS["connect"], "SELECT COUNT(*) as count FROM $table");
    while($row = mysqli_fetch_assoc($query)){
        $count = $row['count'];
    }
    return $count;
}

function getRows($table){

    $query = mysqli_query($GLOBALS["connect"], "SELECT * FROM $table");
    while($row = mysqli_fetch_assoc($query)){
        $result[] = $row;
    }

    return $result;
}

function getRowWhere($table, $where, $value){
    $value = escape_value($value);
    $query = mysqli_query($GLOBALS["connect"], "SELECT * FROM $table  WHERE $where = $value");
    return $row = mysqli_fetch_assoc($query);
}

function getRowsWhere($table, $where, $value){
    $value = escape_value($value);
    $query = mysqli_query($GLOBALS["connect"], "SELECT * FROM $table  WHERE $where = $value");
    while($row = mysqli_fetch_assoc($query)){
        $result[] = $row;
    }
    return $result;
}

function getCountWhere($table, $where, $value){
    $count = 0;
    $value = escape_value($value);
    $query = mysqli_query($GLOBALS["connect"], "SELECT COUNT(*) as count FROM $table  WHERE $where = $value");
    while($row = mysqli_fetch_assoc($query)){
        $count = $row['count'];
    }
    return $count;
}

/*print getCountWhere('`orders`', '`order_status`', 'Delivered');*/

/*echo print_r(getRowsWhere('`orders`', '`order_status`', 'Delivered'));
foreach (getRowsWhere('`orders`', '`order_status`', 'Delivered')as $orders) {
   echo $orders['order_id'];
}*/

