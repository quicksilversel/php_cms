<div class="header">
	<nav class="navbar navbar-expand-lg">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse navbar-login" id="navbarText">
			<ul class="navbar-nav ml-auto">
			<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo BASE_URL . 'admin/dashboard.php'; ?>"><?php echo $_SESSION['user']['username'] ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo BASE_URL . 'logout.php'; ?>">Logout</a>	
				</li>
			<?php else: ?>
				<li class="nav-item">
					<a href=<?php echo BASE_URL . 'login.php'; ?>>Login </a>
				</li>
				<li class="nav-item">
					<a href="<?php echo BASE_URL . 'register.php'; ?>">Register</a>
				</li>
			<?php endif ?>
			</ul>
		</div>
	</nav>
</div>