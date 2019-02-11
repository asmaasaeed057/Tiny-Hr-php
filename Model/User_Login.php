<?php
require_once("config.php");
$errors = array(); 
if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (empty($username)) {
        array_push($errors, "Username is required");       
    }    

    if (count($errors) == 0) {
        $password = hash("sha256", $password);
        $results = $sqlh->get_record_by_username_and_password($username, $password);
        if (!empty($results)) {
            $_SESSION["username"] = $results[0]['username'];
            $_SESSION["id"]=$results[0]['id'];
            $_SESSION["is_admin"]=$results[0]["is_admin"];
                  
        }else {
            array_push($errors, "Wrong username/password combination");
                   
        }         
    } 
}