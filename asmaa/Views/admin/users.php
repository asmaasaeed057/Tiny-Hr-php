<?php
    $current_index = (isset($_GET["index"]) && is_numeric($_GET['index'])) ? (int)$_GET["index"]:0;
    $count_users = $sqlh->users_count()[0]["count(*)"];
    $next_index = ($current_index + __RECORDS_PER_PAGE__)>=$count_users?$current_index:($current_index + __RECORDS_PER_PAGE__);
    $previous_index = ($current_index - __RECORDS_PER_PAGE__ > 0)?($current_index - __RECORDS_PER_PAGE__):0;
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Views/style.css">
		<link rel="stylesheet" type="text/css" href="Views/style_profile.css">
    </head>

    <body>
	    <ul  style="margin-bottom:60px;">
            <li><a class="active" href="<?php echo $_SERVER["PHP_SELF"]; ?> ">Profile</a></li>           
            <li><a href="<?php echo $_SERVER["PHP_SELF"]."?logout"; ?> ">Logout</a></li>
        </ul>
        
        <table id="table_sty" border="1" style="
		                                        width: 80%;
                                                height: 500px;
                                                background-color: #c39999;
                                                font-size: 26px;
	                                            margin:0 auto 40px; ">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>UserName</th>
                <th>Job</th> 
                <th>More</th>
            </tr>
            <?php
                $sqlh = new MySqlHandler();
                $items=$sqlh->get_data(array(), $current_index);
                foreach ($items as $item) {
                    echo '<tr>';
                    echo '<th>'.$item['id'].'</th>';
                    echo '<th>'.$item['name'].'</th>';
                    echo '<th>'.$item['username'].'</th>';
                    echo '<th>'.$item['job'].'</th>';
                    echo '<th><a href='.$_SERVER["PHP_SELF"].'?id='.$item['id'].'>More</a></th>';
                    echo '</tr>';
                }       
            ?>
        </table>
        <div style="width:400px;margin:0 auto; text-align:center; ">
            <a href="<?php echo $_SERVER["PHP_SELF"]."?index=".$next_index; ?>" class="style-a" style=" 
                    color:red;font-size: 23px;
                    font-weight: bold;
                    text-decoration: none;
                    margin-right: 10px;
                    margin-top: 22px;">NEXT</a>
            <a href="<?php echo $_SERVER["PHP_SELF"]."?index=".$previous_index; ?>" class="style-a" style="
                    color:red; font-size: 23px;
                    font-weight: bold;
                    text-decoration: none;       
                    margin-top: 22px;">PREVIOUS</a>
		</div>           
    </body>
</html>
