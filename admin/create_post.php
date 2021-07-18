<?php  include('../includes/config.php'); ?>
<?php  include('admin_functions.php'); ?>
<?php  include('includes/post_functions.php'); ?>
<?php $topics = getAllTopics();	?>
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
            <!-- Create new post  -->
            <div class="manage create-post">
                <h1>Create/Edit Post</h1>
                <form method="post" enctype="multipart/form-data" action="<?php echo BASE_URL . 'admin/create_post.php'; ?>" >
                    <?php include('../includes/errors.php') ?>

                    <!-- if editing post-->
                    <?php if ($isEditingPost === true): ?>
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <?php endif ?>
                    <!-- input field -->
                    <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
                    <br>
                    <textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
                    <br>
                    <label>Featured image : </label>
                    <input type="file" name="featured_image" >
                    <br>
                    <select name="topic_id">
                        <option value="" selected disabled>Choose topic</option>
                        <?php foreach ($topics as $topic): ?>
                            <option value="<?php echo $topic['id']; ?>">
                                <?php echo $topic['name']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <!-- checkbox for published/unpublished  -->
                    <?php if ($_SESSION['user']['role'] == "Admin"): ?>
                        <?php if ($published == true): ?>
                            <label for="publish">
                                Publish
                                <input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
                            </label>
                        <?php else: ?>
                            <label for="publish">
                                Publish
                                <input type="checkbox" value="1" name="publish">&nbsp;
                            </label>
                        <?php endif ?>
                    <?php endif ?>
                    <br>
                    <!-- Update or Create button -->
                    <?php if ($isEditingPost === true): ?> 
                        <button type="submit" class="btn" name="update_post">Update Post</button>
                    <?php else: ?>
                        <button type="submit" class="btn" name="create_post">Create New Post</button>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </body>
</html>

<script>
	CKEDITOR.replace('body');
</script>