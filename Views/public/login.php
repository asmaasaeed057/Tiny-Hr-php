<?php require_once('Model/User_Login.php') ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="Views/style.css">
    </head>
    <body>
        <div class="header">
            <h2>LOGIN</h2>
        </div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php require_once('Model/errors.php') ?>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button class="btn" name="login_user">Login</button>
            </div>
            <p>
                Not a member yet? <a href="<?php echo $_SERVER["PHP_SELF"]."?sign_up"; ?>">Sign up</a>
            </p>
        </form>        
    </body>
</html>
