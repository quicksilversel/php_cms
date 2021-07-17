<?php include("includes/config.php");?>
<?php include('includes/registration_login.php'); ?>
<?php include("includes/public_function.php");?>

<!DOCTYPE html>
<!-- login page -->
<html>
	<head>
		<?php include("includes/head.php");?>
	</head>
	<body>
		<?php include("includes/navigation.php");?>
		<div id="main-content">
            <?php include("includes/header.php");?>
                <div class="login-container">
                    <form method="post" action="login.php" >
                        <h2 class="text-center">Login</h2>
                        <?php include('includes/errors.php') ?>
                        <input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">
                        <button type="submit" class="text-center" name="login_btn">Login</button>
                        <p class="text-center">
                            Not yet a member? <a href="register.php">Sign up</a>
                        </p>
                    </form>
                </div>
            <?php include("includes/footer.php");?>
        </div>
	</body>
</html>