<?php include("includes/config.php");?>
<?php require_once("includes/public_function.php");?>
<?php 
	if (isset($_GET['topic'])) {
		$topic_id = $_GET['topic'];
		$posts = getPublishedPostsByTopic($topic_id);
	}
?>
<!DOCTYPE html>
<!-- aritlces by topic page -->
<html>
	<head>
		<?php include("includes/head.php");?>
	</head>
	<body>
		<?php include("includes/navigation.php");?>

		<div id="main-content">
            <?php include("includes/header.php");?>
			<h2 class="content-title">
                Articles on <u><?php echo getTopicNameById($topic_id); ?></u>
            </h2>
            <hr>
            <!-- posts -->
            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <div class="post col-lg-6 col-sm-12" style="margin-left: 0px;">
                        <img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post-image" alt="">
                        <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                            <div class="post-info">
                                <h3 class="post-title"><?php echo $post['title'] ?></h3>
                                <div class="info">
                                    <span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
                                    <br>
                                    <span class="read-more">Read more...</span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
		</div>
        <?php include("includes/footer.php");?>
	</body>
</html>