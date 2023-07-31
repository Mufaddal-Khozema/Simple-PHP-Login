<?php
function checkEmail(string $email): string
{
    if(!$email){

        throw new Exception("Email is required");

    } else {
        $email = trim($email);
        $email = stripslashes($email);
        $email = htmlspecialchars($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return $email;

        }
        else throw new Exception('Invalid Email');
    }
}
function validatePassword(string $password): array
    {
        $errorMsgs = [];

        if (!preg_match("/^.{8,256}$/", $password)) {
            array_push($errorMsgs, 'Password length must be 8 or more');
        }

        if (!preg_match("/^(?=.*[a-z]).*$/", $password)) {
            array_push($errorMsgs, "Must have a lowercase character");
        }

        if (!preg_match("/^(?=.*[A-Z]).*$/", $password)) {
            array_push($errorMsgs, "Must have a uppercase character");
        }

        if (!preg_match("/^(?=.*\d).*$/", $password)) {
            array_push($errorMsgs, "Must have a number");
        }

        if (!preg_match("/^(?=.*(\W|_)).*$/", $password)) {
            array_push($errorMsgs, "Must have a special symbol");
        }

        return $errorMsgs;
    }
function checkPassword(string $password): string|array {
    if(!$password){

        throw new Exception("Password is required");

    } else {
        if (!empty(validatePassword($password))){

            throw new Exception(json_encode(validatePassword($password)));

        } else {
            
            return $password;

        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require 'controllers/userController.php';
    $email = $password = '';
    switch ($_POST['request_type']) {
        case 'createUser': 

            $errors = array();

            try {
                $email = checkEmail($_POST['email']);
            } catch (Exception $e) {
                $errors['emailErr'] = $e->getMessage();
            }

            try {
                $password = checkPassword($_POST['password']);
            } catch (Exception $e) {
                $errors['passwordErr'] = $e->getMessage();
            }
            
            if($email && $password){

                $errors["databaseError"] = UserController::createUser($email, $password);

            }
            
            $noError = true;
            foreach($errors as $errName => $errValue) {
                if(!empty($errValue)){
                    $noError = false;
                }
            }
            echo $noError ? json_encode(array("success" => "true")) : json_encode($errors);
            break;
        case 'loginUser':
            $errors = array();
            try
            {
                $email = checkEmail($_POST['email']);
            } catch (Exception $e) 
            {
                $errors['emailErr'] = $e->getMessage();
            }

            try
            {
                $password = checkPassword($_POST['password']);
            } catch (Exception $e)
            {
                $errors['passwordErr'] = $e->getMEssage();
            }

            try {

                UserController::loginUser($email, $password);

            } catch(Exception $e){
                $errors["databaseErr"] = $e->getMessage();
            }
            if(empty($errors)) {
                echo json_encode(array("success" => "true"));
            } else {
                echo json_encode($errors); 
            }
            // $noError = true;
            // foreach($errors as $errName => $errValue) {
            //     if(!empty($errValue)){
            //         $noError = false;
            //     }
            // }
            // echo $noError ?  : json_encode($errors);
            break;
        default:
            echo 'Something Unexpected Occured';
    }

    

}