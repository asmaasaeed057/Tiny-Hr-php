<?php


$db= mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);

                
    $select_path="select * from users";
    $var=mysqli_query($db,$select_path);
    
    while($row=mysqli_fetch_array($var))
    {
        $image_name=$row['image'];
        $cv_name=$row['cv'];
        $user_name=$row['username'];
        $user_job=$row['job'];  
        $name=$row['name']; 
        $id=$row['id'];

    }    
    
        $_SESSION['id']=$id;
        $_SESSION['username']=$user_name;
        $_SESSION['name']=$name;
        $_SESSION['job']=$user_job;
    
?>



<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="views/style_profile.css">    
    </head>
    
    
    <body>

    <ul>
        <li><a class="active" href="#home">profile</a></li>
        <li><a href="<?php echo $_SERVER["PHP_SELF"]."?edit"; ?> ">Edit Profile</a></li>
        <li><a href="<?php echo $_SERVER["PHP_SELF"]."?logout"; ?> ">Logout</a></li>
    </ul>

                              
    <div class="welcome">
        <?php echo"welcome" ."  ".$user_name ?>
    </div>
        

    <div class="profile">
        
            
        <div id="photo">
            <?php echo "<img src='images/$image_name' width=200 height=200>";?>
        </div>
            
            
        <div id="user_name">
            <h1><?php echo 'user name';?> </h1>
            <p><?php echo  $user_name;?><p>
        </div>


        <div id="name">
            <h1><?php echo 'name';?> </h1>
            <p> <?php echo $name;?> </p>
        </div>

            <h1> <?php echo 'job';?> </h1>
            <p><?php echo $user_job;?> </p>
    </div>

        <?php echo "<iframe src='cvs/$cv_name' width=500 height=500></iframe>";?>
      
    </body>
    
</html>