<?php include("includes/config.php");?>
<?php include("includes/public_function.php");?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("includes/head.php");?>
	</head>
	<body>
		<?php include("includes/navigation.php");?>
		<div id="main-content">
            <!-- header --> 
            <?php include("includes/header.php");?>
            <div id="main-content" >
                <div class="page-container">
                    <!-- Post -->
                    <div class="post-container">
                        <?php if ($post['published'] == false): ?>
                            <h3 class="post-title">We're sorry, This post has not been published yet</h3>
                        <?php else: ?>
                            <h3 class="post-title text-center"><?php echo $post['title']; ?></h3>
                            <div class="post-body">
                                <?php echo html_entity_decode($post['body']); ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
		</div>
        <?php include("includes/footer.php");?>
	</body>
</html>