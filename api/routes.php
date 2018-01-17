<?php
/**
 * Created by PhpStorm.
 * User: JINCHURIKI
 * Date: 1/6/2018
 * Time: 08:10
 */


function add_users($user_name_e, $first_name, $last_name, $middle_name, $state, $city, $nation, $current_location, $phone, $email_e, $password, $acct_number_e){

    try{

        $response = null;

        $user_id = escape_value(rand(111111111,999999999));
        $user_name = escape_value($user_name_e);
        $password = escape_value($password);
        $first_name = escape_value($first_name);
        $last_name = escape_value($last_name);
        $middle_name = escape_value($middle_name);
        $state = escape_value($state);
        $city = escape_value($city);
        $nation = escape_value($nation);
        $current_location = escape_value($current_location);
        $phone = escape_value($phone);
        $email = escape_value($email_e);
        $acct_number = escape_value($acct_number_e);


        //TEST EMAIL
/*
        if(is_exist('`users`', '`email`',  $email_e)){
            $response = api_response(false, $email_e, "user already exist");
        }

        //TEST ACCOUNT
        else if(is_exist('`users`', '`account_number`',  $acct_number_e)){
            $response = api_response(false, $acct_number_e, "user already exist");
        }

        //TEST USERNAME
        else if(is_exist('`users`', '`username`',  $user_name_e)){
            $response = api_response(false, $user_name_e, "user already exist");
        }*/



            $query = "INSERT INTO `USERS` (user_id, user_name, first_name, last_name, middle_name, state, city, nationality, current_location, phone_number, email, password, account_number)
          VALUES ($user_id, $user_name, $first_name, $last_name, $middle_name, $state, $city, $nation, $current_location, $phone, $email, $password, $acct_number)";

            $new_user = querydbReturnNewID($query);
            $response = api_response(true, $new_user, null);

        return $response;

    }catch(Exception $exception){
        return api_response(false, null, $exception->getMessage());



    }


}

function fetch_user(){
    for ($i = 0; $i < func_num_args(); $i++) {
        $field = escape_value(func_get_arg($i));
        if ($field) {
            $query = "SELECT * FROM `USERS` WHERE `user_id` = $field";
            $query_db = querydb($query);
            while ($fetch_users = mysqli_fetch_assoc($query_db)) {
                $result[] = $fetch_users;
            }
            return api_response(true, $result, null);
        }

    }
    $query = "SELECT * FROM `USERS`";
    $query_db = querydb($query);
    while ($fetch_users = mysqli_fetch_assoc($query_db)) {
        $result[] = $fetch_users;
    }
    return api_response(true, $result, null);
}


###############################################NATIONS###############################
function add_nation($nation_name_e){

    try {

        $nation_name = escape_value($nation_name_e);
        $nation_id = escape_value(rand(111111111,99999999));

        if(is_exist('`nations`', '`nation_name`',  $nation_name_e)){
            return  api_response(false, $nation_name_e, "user already exist");
        }

        $query = "INSERT INTO `NATIONS` (nation_id, nation_name) VALUES ($nation_id, $nation_name)";
        $new_nation = querydbReturnNewID($query);

        return api_response(true, $new_nation, null);



    }catch (Exception $exception){
        return api_response(false,null, $exception->getMessage());
    }

}

function fetch_nation(){
    for ($i = 0; $i < func_num_args(); $i++) {
        $field = escape_value(func_get_arg($i));
        if ($field) {
            $query = "SELECT * FROM `NATIONS` WHERE `nation_id` = $field";
            $query_db = querydb($query);
            while ($fetch_nation = mysqli_fetch_assoc($query_db)) {
                $result[] = $fetch_nation;
            }
            return api_response(true, $result, null);
        }

    }
    $query = "SELECT * FROM `NATIONS`";
    $query_db = querydb($query);
    while ($fetch_nation = mysqli_fetch_assoc($query_db)) {
        $result[] = $fetch_nation;
    }
    return api_response(true, $result, null);
}


############################################LOGIN##########################
function doLogin($email, $username, $password){
    try{
        $email = escape_value($email);
        $password = escape_value($password);
        $username = escape_value($username);

        $sql = "SELECT * FROM `USERS` WHERE `email` = $email OR user_name = $username AND `password` = $password";
        $query_db = querydb($sql);
        $rows = mysqli_fetch_assoc($query_db);
        if($rows > 0){

            $result = $rows;


            return api_response(true, $result, null);
        }

        return api_response(false, null, "Invalid user name or password");

    }catch (Exception $exception){
        return api_response(false,null, $exception->getMessage());
    }
}
