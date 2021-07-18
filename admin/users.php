<?php include('../includes/config.php'); ?>
<?php include('admin_functions.php'); ?>
<?php 
	$admins = getAdminUsers();
	$roles = ['Admin', 'Author'];				
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("../includes/head.php"); ?>
	</head>
	<body>
		<!-- side nav -->
		<?php include("../includes/navigation.php");?>
		<div id="main-content">
			<!-- header -->
            <?php include("../includes/header.php");?>
			<a href="<?php echo BASE_URL . 'admin/dashboard.php' ?>">Go back to dashboard</a>
			<!-- Manage users -->
			<div class="manage">
				<h1>Create/Edit Admin User</h1>
				<form method="post" action="<?php echo 'users.php'; ?>" >
					<?php include('../includes/errors.php') ?>
					<!-- if editing user -->
					<?php if ($isEditingUser === true): ?>
						<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
					<?php endif ?>

					<!-- input field -->
					<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
					<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
					<input type="password" name="password" placeholder="Password">
					<input type="password" name="passwordConfirmation" placeholder="Password confirmation">
					<select name="role">
						<option value="" selected disabled>Assign role</option>
						<?php foreach ($roles as $key => $role): ?>
							<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
						<?php endforeach ?>
					</select>

					<!-- Update / Save Button -->
					<?php if ($isEditingUser === true): ?> 
						<button type="submit" name="update_admin">Update</button>
					<?php else: ?>
						<button type="submit" name="create_admin">Save User</button>
					<?php endif ?>
				</form>
			</div>
			<!-- existing user table -->
			<div class="table-div">
				<!-- notification message -->
				<?php include('../includes/messages.php') ?>

				<?php if (empty($admins)): ?>
					<h1>No admins in the database.</h1>
				<?php else: ?>
					<table class="table manage-table">
						<thead>
							<th>ID</th>
							<th>Username</th>
							<th>Email</th>
							<th>Role</th>
							<th>Edit</th>
							<th>Delete</th>
						</thead>
						<tbody>
						<?php foreach ($admins as $key => $admin): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td>
									<?php echo $admin['username']; ?>
								</td>
								<td><?php echo $admin['email']; ?>	</td>
								<td><?php echo $admin['role']; ?></td>
								<td>
									<a class="fa fa-pencil btn edit"
										href="users.php?edit-admin=<?php echo $admin['id'] ?>">
									</a>
								</td>
								<td>
									<a class="fa fa-trash btn delete" 
										href="users.php?delete-admin=<?php echo $admin['id'] ?>">
									</a>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				<?php endif ?>
			</div>
		</div>
	</body>
</html>