<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<!-- Navbar -->
<nav id="side-navbar">
  <ul class="navbar-items flexbox-col">
    <!-- logo -->
    <li class="navbar-logo flexbox-left">
      <a class="navbar-item-inner flexbox" href="./">
        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 1438.88 1819.54">
          <polygon points="925.79 318.48 830.56 0 183.51 1384.12 510.41 1178.46 925.79 318.48"/>
          <polygon points="1438.88 1663.28 1126.35 948.08 111.98 1586.26 0 1819.54 1020.91 1250.57 1123.78 1471.02 783.64 1663.28 1438.88 1663.28"/>
        </svg>
      </a>
    </li>
    <!-- categories -->
 
    <?php foreach ($topics as $topic): ?>
      <li class="navbar-item flexbox-left">
        <a class="navbar-item-inner flexbox-left" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
          <div class="navbar-item-inner-icon-wrapper flexbox">
        <i class="far fa-folder-open"></i>
          </div>
          <span class="link-text">
            <?php echo $topic['name']; ?>
          </span>
        </a>
      </li>
    <?php endforeach ?>

    
  </ul>
</nav>