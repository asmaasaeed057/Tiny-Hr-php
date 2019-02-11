<?php
    $id = (isset($_GET["id"]))?(int)$_GET["id"]:0;
    $current_item = $sqlh->get_record_by_id($id,"id")[0];
        
    $image_name=$current_item['image'];
    $cv_name=$current_item['cv'];                    
?>

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="Views/style_profile.css">        
    </head>  
    <body>
        <ul>
            <li><a class="active" href="<?php echo $_SERVER["PHP_SELF"]; ?> ">Profile</a></li>           
            <li><a href="<?php echo $_SERVER["PHP_SELF"]."?logout"; ?> ">Logout</a></li>
        </ul>                              
        <div class="welcome">
            <?php echo"welcome" ."  ".$current_item['username'] ?>
        </div>        

        <div class="profile">   

            <div id="photo">
                <?php echo "<img src='images/$image_name' width=200 height=200>";?>
            </div>  

            <div id="user_name">
                <h1><?php echo 'user name';?> </h1>
                <p><?php echo $current_item['username'];?><p>
            </div>

            <div id="name">
                <h1><?php echo 'name';?> </h1>
                <p> <?php echo $current_item['name'];?> </p>
            </div>  

            <h1> <?php echo 'job';?> </h1>
            <p><?php echo $current_item['job'];?> </p>                   
        </div>  
                    
        <?php
            echo "<iframe src='cvs/$cv_name' width=500 height=500></iframe>";
        ?>
       
    </body>   
</html>