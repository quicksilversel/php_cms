<?php include('../includes/config.php'); ?>
<?php include('admin_functions.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("../includes/head.php"); ?>
	</head>
	<body>
		<!-- dashboard -->
		<?php include('../includes/navigation.php'); ?>
		<div id="main-content">
			<!-- header -->
			<?php include("../includes/header.php");?>
			<div class="container dashboard">
				<h1 class="text-center">Welcome, <?php echo $_SESSION['user']['username'] ?></h1>
				<table class="table dashboard-table">
					<tbody>
						<tr>
							<td><a href="<?php echo BASE_URL . 'admin/create_post.php' ?>">Create Posts</a></td>
						</tr>
						<tr>
							<td><a href="<?php echo BASE_URL . 'admin/posts.php' ?>">Manage Posts</a></td>
						</tr>
						<tr>
							<td><a href="<?php echo BASE_URL . 'admin/topics.php' ?>">Manage Topics</a></td>
						</tr>
						<tr>
							<td><a href="<?php echo BASE_URL . 'admin/users.php' ?>">Manage Users</a></td>
						</tr>
					</tbody>
				</div>
			</div>
						
		</div>
	</body>
</html>
