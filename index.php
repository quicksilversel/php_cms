<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>
<?php $posts = getPublishedPosts(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("includes/head.php");?>
	</head>
	<body>
		<?php include("includes/navigation.php");?>

		<div id="main-content">
            <?php include("includes/header.php");?>
			<h2>Welcome to my blog!</h2>
			<hr>

            <?php foreach ($posts as $post): ?>
                <div class="post" style="margin-left: 0px;">
                    <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                        <div class="post_info">
                            <h3><?php echo $post['title'] ?></h3>
                            <div class="info">
                                <span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                                <span class="read_more">Read more...</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
            <?php include("includes/footer.php");?>
		</div>

	</body>
</html>