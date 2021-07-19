<?php include("includes/config.php");?>
<?php include('includes/registration_login.php'); ?>
<?php include("includes/public_function.php");?>


<!DOCTYPE html>
<html>
	<head>
		<?php include("includes/head.php");?>
	</head>
	<body>
		<?php include("includes/navigation.php");?>
		<div id="main-content">
            <?php include("includes/header.php");?>
            <div class="login-container">
                <form method="post" action="register.php" >
                    <h2 class="text-center">Sign Up</h2>
                    <?php include('includes/errors.php') ?>
                    <input type="text" name="username" value="<?php echo $username; ?>"  placeholder="Username">
                    <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
                    <br>
                    <input type="password" name="password_1" placeholder="Password">
                    <input type="password" name="password_2" placeholder="Password confirmation">
                    <br>
                    <button type="submit" name="reg_user">Register</button>
                    <p class="text-center">
                        Already a member? <a href="<?php echo BASE_URL . "login.php"?>">Sign in</a>
                    </p>
                </form>
            </div>
		</div>

	</body>
</html>