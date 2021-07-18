<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>
<?php require_once('includes/registration_login.php') ?>
<?php $posts = getPublishedPosts(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("includes/head.php");?>
	</head>
	<body>
        <!-- side nav -->
		<?php include("includes/navigation.php");?>
		<div id="main-content">
            <!-- header -->
            <?php include("includes/header.php");?>
			<h2>Welcome to my blog!</h2>
			<hr>          
            <!-- posts -->
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <?php if (isset($post['topic']['name'])): ?>
                        <!-- topic -->
                        <a href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>">
                            <?php echo $post['topic']['name'] ?>
                        </a>
                    <?php endif ?>
                    <br>
                    <img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post-image" alt="">
                    <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                        <div class="post-info">
                            <h3 class="post-title"><?php echo $post['title'] ?></h3>
                            <div class="post-body">
                                <span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                                <br>
                                <span class="read-more">Read more...</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
            <?php include("includes/footer.php");?>
		</div>

	</body>
</html>