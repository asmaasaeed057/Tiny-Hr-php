<?php
require_once("autoload.php");
define("_ALLOW_ACCESS", 1);
session_start();
//session_regeneratse_id();
require_once("config.php");
$sqlh = new MySqlHandler();
//echo (1==TRUE)."test";
//********************************************//
//Routing
if (isset($_GET['logout'])) {
  	session_destroy();
  	header("location: index.php");
  }

if (isset($_SESSION["id"]) && isset($_SESSION["is_admin"])) { 
    if ($_SESSION["is_admin"] == 1) { 
    //admin views should be required here
        //echo 'admin';
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            //echo $_GET["id"];
            require_once 'Views/admin/user.php';
            echo 'user';
        } else {
            //echo 'users';
            require_once 'Views/admin/users.php';
            //echo __DIR__;
            
            
        }
        
        
} elseif ($_SESSION["is_admin"] == 0){
        
            if(isset($_GET["edit"])){
            //echo $_GET["id"];
            require_once 'Views/member/edit_my_profile.php';
                
            } else {
                require_once 'Views/member/view_my_profile.php';
            
            }

    }
} 


//********************************************//
else {
    if (isset($_GET["sign_up"])) 
    { require_once 'Views/public/signup.php'; }

    elseif (isset($_POST['register_btn'])) 
    { require_once 'Views/public/signup.php'; }

    else 
    { require_once 'Views/public/login.php'; }
    
}