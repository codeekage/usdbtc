<?php
/**
 * Created by PhpStorm.
 * User: JINCHURIKI
 * Date: 1/15/2018
 * Time: 10:27
 */

"AFROSOFTdev907yUgkiLLMisTER";
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

            }catch(Exception $exception){
                echo api_response(false, null, $exception->getMessage());
            }
            break;

        default :
            echo api_response(false, null, "invalid route");
            break;
    }


}