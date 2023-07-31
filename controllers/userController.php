<?php 
require 'db_conn.php';
class UserController 
{
    public static function createUser(string $email, string $password) 
    {
        global $conn;
        try {
            $sql = "SELECT * FROM users WHERE email='$email'";
            $results = $conn->query($sql);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            if(is_array($row) && count($row)>0){
                return "Account of this email already exists";
            }else {
                $stmt = $conn->prepare("INSERT INTO users (email, password) VALUE(?,?)");
                $res = $stmt->execute([$email,password_hash($password,PASSWORD_DEFAULT)]);
                if(!$res){
                    return "failed to make database entry";
                }
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function loginUser(string $email, string $password) 
    {
        global $conn;
        try {
            $sql = "SELECT * FROM users WHERE email='$email'";
            $results = $conn->query($sql);
            $row = $results->fetch(PDO::FETCH_ASSOC);
            if(is_array($row) && count($row)>0){
                $hash = $row["password"];
                if(!password_verify($password, $hash)){
                    throw new Exception("Incorrect Password");
                };
            }

        } catch (PDOException $e) {
            return $e;
        }
    }
}