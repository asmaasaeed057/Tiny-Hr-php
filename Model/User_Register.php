<?php
 
   $sqlh = new MySqlHandler();
   $db=$sqlh->connect();
   $errors=array();
   $msg = "";

   if(isset($_POST['register_btn']))
    {    
         // receive all input values from the form
         $username =$_POST['username'];
         $password = $_POST['password'];
         $password2 =  $_POST['password2'];
         $name = $_POST['name'];
         $job = $_POST['job'];

         //get submited pdf $img
         $image=$_FILES['img']['name'];
         $pdf=$_FILES['pdf']['name'];


         //upload image in folder &cv
        
  	      //path to store uploaded img
         $target = "images/".basename($_FILES['img']['name']);
         $targetcv="cvs/";
         $targetcv=$targetcv.basename($_FILES['pdf']['name']);

         //form validation 
         if (empty($username)) { array_push($errors, "Username is required"); }

         if (empty($password)) { array_push($errors, "password is required"); }
          
         if ($password!=$password2) {array_push($errors,"Two password dont match");}

         if(strlen($password) <= '8' || strlen($password) >='16'){array_push($errors,"password should be between 8 &16 characters");}

   
        
         //move uploadedcimg to images folder
  	      if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
  		      $msg = "Image uploaded successfully";
         }
         else{
  		      $msg = "Failed to upload image";
  	      }
        
         if (move_uploaded_file($_FILES['pdf']['tmp_name'], $targetcv)) {
              $msg = "pdf uploaded successfully";
              
  	      }else{

              $msg = "Failed to upload pdf";
         }
   
         //img & pdf
         if(isset($_FILES['img'])){

               $uploads_dir=__IMGPATH__;
               $file_tmp = $_FILES['img']['tmp_name'];
               $file_name = $_FILES['img']['name'];
               move_uploaded_file($file_tmp ,$uploads_dir.$file_name);
               
               $file_size = $_FILES['img']['size'];
               $file_type = $_FILES['img']['type'];
            
               $te=explode('.',$file_name);
               $file_ext=strtolower(end($te));

               $extensions= array("jpg");

               if(in_array($file_ext,$extensions)=== false){
                  array_push($errors ,"extension not allowed, please choose jpg file.");
               }

               if($file_size > 1000000) {
                  array_push($errors ,'File size must be excately 1 MB');
               }
            }
        //cv
       if(isset($_FILES['pdf'])){
               $uploads_dir=__CVPATH__;
               $file_name = $_FILES['pdf']['name'];
               $file_tmp = $_FILES['pdf']['tmp_name'];
               move_uploaded_file($file_tmp ,$uploads_dir.$file_name);

               $file_size = $_FILES['pdf']['size'];
               $file_type = $_FILES['pdf']['type'];
               $te=explode('.',$file_name);
               $file_ext=strtolower(end($te));

               $extensions= array("pdf");

               if(in_array($file_ext,$extensions)=== false){
                     array_push($errors ,"extension not allowed, please choose pdf file.");
               }

               if($file_size > 1000000) {
                     array_push($errors ,'File size must be excately 1 MB');
               }
    }
         
    
  /*function google(&$errors)
  {
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
    {
          $secret = '6Lenc5AUAAAAAG-LdM16N1QGkC-nomNA5Vd-h_AU';
          $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
          $responseData = json_decode($verifyResponse);
          if($responseData->success)
          {
              $succMsg = 'Your contact request have submitted successfully.';
          }
          else
          {
              $errMsg = 'Robot verification failed, please try again.';
              array_push($errors, $errMsg); 

          }
     }
   else{
      array_push($errors, "you must check google recaptia "); 
   }    
  } */    
     
        //---------------------------------------------

       
        
        //google($errors);   
            if (count($errors) == 0){
               $password = hash("sha256", $password);
               $sqlh->insert_user($username,$password,$name,$job,$image,$pdf);
               $_SESSION["username"]=$username;
               $user_id=$sqlh-> get_user_id($username);

               $_SESSION["id"]=$user_id;
               $_SESSION["is_admin"]= 0;
               $_SESSION["name"]=$name;
               $_SESSION["job"]=$job;
               $_SESSION["pdf"]=$pdf;
               $_GET['id']= $user_id;
               require_once ($_SERVER["PHP_SELF"]);
            }
            
}
