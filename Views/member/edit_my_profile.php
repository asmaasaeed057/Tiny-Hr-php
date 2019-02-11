
<?php
require_once ('Model/User_Register.php') ;
$sqlh = new MySqlHandler();
$db=$sqlh->connect();

$id= $_SESSION["id"];
$user_name= $_SESSION['username'];
$name=$_SESSION['name'];
$user_job=$_SESSION['job'];



if (isset($_POST['update'])) {
   
	$name = $_POST['name'];
	$username = $_POST['username'];
	$job = $_POST['job'];
	$sqlh->update_user($username,$name,$job,$id);
	header('location:index.php');

	}
 ?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Views/style.css">   
    </head>
<body>

    <div class="header">
      <h2>Update your profile</h2>
    </div>




    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?edit"; ?> " enctype="multipart/form-data">
				<?php require_once ('Model/errors.php') ?>

					<div class="input-group">
						<label>Username:</label>
						<input type="text" name="username" value="<?php echo $user_name ?>" >
					</div>
						
					<div class="input-group">
						<label>Your Name:</label>
						<input type="text" name="name" value="<?php echo $name ?>">
					</div>
							
					<div class="input-group">
						<label>Your Job:</label>
						<input type="text" name="job" value="<?php echo $user_job ?>">
					</div>
							
							
					<div class="input-group">
						<label>Upload image</label>
						<input type="file" name="img" >
					</div>
					
							
					<div class="input-group">
						<label>Upload CV</label>
						<input type="file" name="pdf" >
					</div>
							
					<div class="input-group">
						<button type="submit" class="btn" name="update" value="update">Update</button>
					</div>
		</form>
    
	</body>
</html>  