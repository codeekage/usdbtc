<?php
require 'db-connect.php';

#parameter validation from url, this makes sure every params in 
#the url is not missing before excuting the controller functions
#func_num_args counts the number of params in the checkField function 
#before performing validations... 
#where $fields are equal to func_get_args($args)... and args is from the forLoop
#function returns true or false....
function checkFields(){
    for ($i = 0; $i < func_num_args(); $i++) {
        $field = func_get_arg($i);
        if ($field === null)
            return false;
    }
    return true;
}

#retrives the string from the params in the urls where it's args is name of the params 
#checks for the given args, see if empty, performs a get_request and excutes the controller functions
#returns values or return null if empty...
function getStringParams($value)
{
    if (isset($_GET[$value]) && !empty($_GET[$value]))
    {
        $value = trim($_GET[$value]);
        if ($value != '')
            return $value;
    }

    return null;
}

#gets value and send to controller functions.
function getParams($value)
{
    if (isset($_GET[$value]))
        return $_GET[$value];

    return null;
}

//
function escape_value($value){
    if($value == " ")
        return null;
    return "'". mysqli_real_escape_string($GLOBALS['connect'], $value). "'";
}

function get_file($file){
    if($file == " ")
    return null;
    return  "'".$_FILES[$file]."'";
}

//return post request
function postStringParams($value){
    if (isset($_POST[$value]) && !empty($_POST[$value]))
    {
        $value = trim($_POST[$value]);
        if ($value != '')
            return $value;
    }

    return null;
}

//query database
function querydb($sql, $return_auto = false, $return_affected_rows = false){
    $query = mysqli_query($GLOBALS['connect'], $sql);
    if($query){
        if($return_auto){
            $auto = mysqli_insert_id($GLOBALS['connect']);
            return $auto;
        }else if($return_affected_rows){
            $affected = mysqli_affected_rows($GLOBALS['connect']);
            return $affected;
        }
        return $query;
    }else{
        $error = mysqli_error($GLOBALS['connect']);
        return $error;
    }

}

#check if a data exist before insertion
function is_exist($table, $where, $value){

        $value = escape_value($value);
        $check_query = querydb("SELECT * FROM $table WHERE $where = $value");
        if(mysqli_fetch_assoc($check_query) > 1){
            return true;
        }
        return false;
}


//return new id after insertion
function querydbReturnNewID($query_build)
{
    return querydb($query_build, true);
}

//retrun afftected rows after delete or updated
function querydbReturnAffectedRows($query_build)
{
    return querydb($query_build, false, true);
}

function api_response($success, $data, $error_message){
    $result = [];
    $result['success'] = $success;
    $result['data'] = $data;
    $result['error_message'] = $error_message;
    return json_encode($result);
}

