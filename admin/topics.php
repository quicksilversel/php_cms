<?php include('../includes/config.php'); ?>
<?php include('admin_functions.php'); ?>
<?php $topics = getAllTopics(); ?>
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
			<!-- Manage topics-->
			<div class="manage">
				<h1>Create/Edit Topics</h1>
				<form method="post" action="<?php echo 'topics.php'; ?>" >
					<?php include('../includes/errors.php') ?>
					<!-- if editing topic -->
					<?php if ($isEditingTopic === true): ?>
						<input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
					<?php endif ?>
					<!-- input field -->
					<input type="text" name="topic_name" value="<?php echo $topic_name; ?>" placeholder="Topic">
					
					<!-- update / create button -->
					<?php if ($isEditingTopic === true): ?> 
						<button type="submit" name="update_topic">UPDATE</button>
					<?php else: ?>
						<button type="submit" name="create_topic">Save Topic</button>
					<?php endif ?>
				</form>
			</div>
			<!-- display exists topics -->
			<div class="table-div">
				<!-- notification message -->
				<?php include('../includes/messages.php') ?>
				<?php if (empty($topics)): ?>
					<h1>No topics in the database.</h1>
				<?php else: ?>
					<table class="table manage-table">
						<thead>
							<th>ID</th>
							<th>Topic Name</th>
							<th>Edit</th>
							<th>Delete</th>
						</thead>
						<tbody>
							<?php foreach ($topics as $key => $topic): ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $topic['name']; ?></td>
									<td>
										<a class="fa fa-pencil btn edit"
											href="topics.php?edit-topic=<?php echo $topic['id'] ?>">
										</a>
									</td>
									<td>
										<a class="fa fa-trash btn delete"								
											href="topics.php?delete-topic=<?php echo $topic['id'] ?>">
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