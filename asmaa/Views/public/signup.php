<?php require_once ('Model/User_Register.php') ; ?>
<!DOCTYPE html>
<html>

	<head>
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="Views/style.css">
		<script src='https://www.google.com/recaptcha/api.js' async defer > </script>
	</head>

	<body>

		<div class="header">
			<h2>Register</h2>
		</div>

		<a href="signup.php"></a>

			<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?> " enctype="multipart/form-data">

				<?php require_once ('Model/errors.php') ?>
					
						<div class="input-group">
							<label>Username:</label>
							<input type="text" name="username"  >
						</div>
							
							
						<div class="input-group">
							<label>Password:</label>
							<input type="password" name="password" >
						</div>
							
					
						<div class="input-group">
							<label>Confirm password:</label>
							<input type="password" name="password2">
						</div>
							
							
						<div class="input-group">
							<label>Your Name:</label>
							<input type="text" name="name" >
						</div>
								
						<div class="input-group">
							<label>Your Job:</label>
							<input type="text" name="job" >
						</div>
								
								
						<div class="input-group">
							<label>Upload image</label>
							<input type="file" name="img" >
						</div>
						
								
						<div class="input-group">
							<label>Upload CV</label>
							<input type="file" name="pdf">
						</div>

						<div class="g-recaptcha" data-sitekey="6Lenc5AUAAAAABoKz3e0knQQafSBrUMDEAUv_4iQ"></div>

						<div class="input-group">
							<button type="submit" class="btn" name="register_btn">Register</button>
						</div>
							
						<p>
							Already a member? <a href="<?php echo $_SERVER["PHP_SELF"]; ?>">Sign in</a>
						</p>
				
			</form>
			
	</body>
</html>