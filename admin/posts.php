<?php include('../includes/config.php'); ?>
<?php include('admin_functions.php'); ?>
<?php include('post_functions.php'); ?>
<?php $posts = getAllPosts(); ?>
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
            <a href="<?php echo BASE_URL . 'admin/dashboard.php' ?>">Return to dashboard</a>
            <!-- manage posts -->
            <div class="manage">
                <h1>Manage Posts</h1>
                <div class="table-div"  style="width: 80%;">
                    <!-- notification message -->
                    <?php include('../includes/messages.php') ?>

                    <?php if (empty($posts)): ?>
                        <h1>No posts in the database.</h1>
                    <?php else: ?>
                        <table class="table manage-table">
                                <thead>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Views</th>

                                <!-- Only Admin can publish/unpublish post -->
                                <?php if ($_SESSION['user']['role'] == "Admin"): ?>
                                    <th>Publish</th>
                                <?php endif ?>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                            <?php foreach ($posts as $key => $post): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $post['author']; ?></td>
                                    <td>
                                        <a 	target="_blank"
                                        href="<?php echo '../single_post.php?post-slug=' . $post['slug'] ?>">
                                            <?php echo $post['title']; ?>	
                                        </a>
                                    </td>
                                    <td><?php echo $post['views']; ?></td>
                                    
                                    <!-- Only Admin can publish/unpublish post -->
                                    <?php if ($_SESSION['user']['role'] == "Admin" ): ?>
                                        <td>
                                        <?php if ($post['published'] == true): ?>
                                            <a class="fa fa-check btn unpublish"
                                                href="posts.php?unpublish=<?php echo $post['id'] ?>">
                                            </a>
                                        <?php else: ?>
                                            <a class="fa fa-times btn publish"
                                                href="posts.php?publish=<?php echo $post['id'] ?>">
                                            </a>
                                        <?php endif ?>
                                        </td>
                                    <?php endif ?>

                                    <td>
                                        <a class="fa fa-pencil btn edit"
                                            href="create_post.php?edit-post=<?php echo $post['id'] ?>">
                                        </a>
                                    </td>
                                    <td>
                                        <a class="fa fa-trash btn delete" 
                                            href="create_post.php?delete-post=<?php echo $post['id'] ?>">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php endif ?>
                </div>
            </div>
            <a href="<?php echo BASE_URL . 'admin/create_post.php' ?>">Create a new post</a>

        </div>
    </body>
</html>