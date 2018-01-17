<?php
/**
 * Created by PhpStorm.
 * User: JINCHURIKI
 * Date: 1/13/2018
 * Time: 07:22
 */
require_once "model/app-function.php";
require_once "routes.php";
require_once "model/get-details.php";

//get api key
$api_key = getRows('`api`')[0]['api_key'];

if(md5($_GET['api_key']) === $api_key){
    if(isset($_POST['post'])){
        switch(strtolower($_POST['post'])){
            case 'register' :
                try{
                    $user_name = postStringParams('username');
                    $password = postStringParams('password');
                    $first_name = postStringParams('first_name');
                    $last_name = postStringParams('last_name');
                    $middle_name = postStringParams('middle_name');
                    $state = postStringParams('state');
                    $city = postStringParams('city');
                    $nation = postStringParams('nation');
                    $current_location = postStringParams('clocation');
                    $phone = postStringParams('phone_number');
                    $email = postStringParams('email');
                    $acct_number = postStringParams('acct_number');

                    if(checkFields($user_name, $first_name, $last_name, $middle_name, $state, $city, $nation, $current_location, $phone, $email, $acct_number)){
                        echo add_users($user_name, $first_name, $last_name, $middle_name, $state, $city, $nation, $current_location, $phone, $email, $password, $acct_number);
                    }else{
                        echo api_response(false, null, "missing parameters");
                    }

                }catch(Exception $exception){
                    echo api_response(false, null, $exception->getMessage());
                }
            break;

            case 'nations' :
                try {
                    $nation_name = postStringParams('n_name');

                    if(checkFields($nation_name)){
                        echo add_nation($nation_name);
                    }else {
                        echo api_response(false, null, "missing parameters");
                    }

                }catch(Exception $exception){
                    echo api_response(false, null, $exception->getMessage());
                }
            break;

            case 'login' :
                try{
                    $email = postStringParams('email');
                    $password = postStringParams('password');
                    $username = postStringParams('username');

                    echo doLogin($email, $username, $password);
                }catch(Exception $exception){
                    echo api_response(false, null, $exception->getMessage());
                }

            break;
        }
    }
}else{
    echo api_response(false, null, "Invalid API_KEY");
}
