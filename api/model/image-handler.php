<?php
require 'db-connect.php';
require 'app-function.php';


function doInsertFile($image){
    try{
        #parameter variable declaration
        $imageFile = get_file($image);;
    

        #app variable declaration
        $target_dir = "uploads/";
        $target_file = $target_dir .basename($imageFile["name"]);
        $uploadOk = true;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        #check if an image
        $check = getimagesize($imageFile["tmp_name"]);
        if (!$check) {
            echo "File is not an image.";
            $uploadOk = false;
        }
        #check if file exists in directory
        if (file_exists($target_file)) {
            echo "File already exits";
            $uploadOk = false;
        }

        #check image sixe before uploading 
        if ($imageFile["size"] > 1500000) {
            $uploadOk = false;
            echo "image is too large";
        }

        #check image format before accepting file for upload 
        if ($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG"
            && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
            echo "oops! this file is not an image file";
            $uploadOk = false;
        }

        #check upload status [$uploadOk] if true
        if (!$uploadOk) {
            echo "sorry file cannot be uploaded at this time";
        } else {
            $imageData = mysqli_real_escape_string($GLOBALS['connect'], file_get_contents($imageFile["tmp_name"]));
            if (move_uploaded_file($imageFile["tmp_name"], $target_file)) {

                $uploads = $target_file;

                $query = "INSERT INTO free_lancer_uploads (email, upload, category) VALUES ($email, $uploads, $category)";
                $auto = mysqli_query($GLOBALS['connect'], $query);
                if($auto){
                    echo api_response(true, $free_lancer, 'done');
                }
                //$free_lancer['free_lancer'] = $auto;
            }
        }

    }catch(Exception $ex){
        echo $ex->getMessage();
    }
}

?>