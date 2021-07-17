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
            <?php foreach ($posts as $post): ?>
                <div class="post" style="margin-left: 0px;">
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
            <?php include("includes/footer.php");?>
		</div>
	</body>
</html>