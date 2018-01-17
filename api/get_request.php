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
    if(isset($_GET['fetch'])){
        switch (strtolower($_GET['fetch'])){
            case 'users' :
                try {
                    $user_id = getStringParams('uid');

                    if(checkFields($user_id)){
                        echo fetch_user($user_id);
                    }else{
                        echo fetch_user();
                    }

                }catch (Exception $exception){
                    echo api_response(false, null, $exception);
                }
            break;

            case 'nations' :
                try {
                    $nation_id = getStringParams('nid');

                    if(checkFields($nation_id)){
                        echo fetch_nation($nation_id);
                    }else{
                        echo fetch_nation();
                    }

                }catch (Exception $exception){
                    echo api_response(false, null, $exception);
                }
            break;


            default :
                echo api_response(false, null, "Invalid ROUTE");
            break;
        }
    }
}else{
    echo api_response(false, null, "Invalid API_KEY");
}
