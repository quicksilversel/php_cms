<?php 
// Post variables
$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$post_topic = "";


// get all posts from DB
function getAllPosts()
{
	global $conn;
	
	// Admin can view all posts
	// Author can only view their posts
	if ($_SESSION['user']['role'] == "Admin") {
		$sql = "SELECT * FROM posts";
	} elseif ($_SESSION['user']['role'] == "Author") {
		$user_id = $_SESSION['user']['id'];
		$sql = "SELECT * FROM posts WHERE user_id=$user_id";
	}
	$result = mysqli_query($conn, $sql);
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['author'] = getPostAuthorById($post['user_id']);
		array_push($final_posts, $post);
	}
	return $final_posts;
}

// get the author/username of a post
function getPostAuthorById($user_id)
{
	global $conn;
	$sql = "SELECT username FROM users WHERE id=$user_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		// return username
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}

// if user clicks the create post button
if (isset($_POST['create_post'])) { createPost($_POST); }
// if user clicks the Edit post button
if (isset($_GET['edit-post'])) {
	$isEditingPost = true;
	$post_id = $_GET['edit-post'];
	editPost($post_id);
}
// if user clicks the update post button
if (isset($_POST['update_post'])) {
	updatePost($_POST);
}
// if user clicks the Delete post button
if (isset($_GET['delete-post'])) {
	$post_id = $_GET['delete-post'];
	deletePost($post_id);
}

// Post functions
function createPost($request_values) {
	global $conn, $errors, $title, $featured_image, $topic_id, $body, $published;
	$title = esc($request_values['title']);
	$body = htmlentities(esc($request_values['body']));
	if (isset($request_values['topic_id'])) {
		$topic_id = esc($request_values['topic_id']);
	}
	if (isset($request_values['publish'])) {
		$published = esc($request_values['publish']);
	}
	$post_slug = makeSlug($title);
	// validate form
	if (empty($title)) { array_push($errors, "Post title is required"); }
	if (empty($body)) { array_push($errors, "Post body is required"); }
	if (empty($topic_id)) { array_push($errors, "Post topic is required"); }
	// Get image name
	$featured_image = $_FILES['featured_image']['name'];
	if (empty($featured_image)) { array_push($errors, "Featured image is required"); }
	// image file directory
	$target = "../static/images/" . basename($featured_image);
	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		array_push($errors, "Failed to upload image. Not uploaded because of error #". $_FILES["featured_image"]["error"]);
	}
	// Ensure that no post is saved twice. 
	$post_check_query = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
	$result = mysqli_query($conn, $post_check_query);

	if (mysqli_num_rows($result) > 0) { 
		array_push($errors, "A post already exists with that title.");
	}
	// create post
	if (count($errors) == 0) {
		$user_id = $_SESSION['user']['id'];
		$query = "INSERT INTO posts (user_id, title, slug, image, body, published, created_at, updated_at) VALUES($user_id, '$title', '$post_slug', '$featured_image', '$body', $published, now(), now())";
		if(mysqli_query($conn, $query)){ // if post created successfully
			$inserted_post_id = mysqli_insert_id($conn);
			// create relationship between post and topic
			$sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
			mysqli_query($conn, $sql);

			$_SESSION['message'] = "Post created successfully";
			header('location: posts.php');
			exit(0);
		}
	}
}

// Edit Post : Takes post id as parameter
function editPost($role_id) {
	global $conn, $title, $post_slug, $body, $published, $isEditingPost, $post_id, $topic_id, $topic_name, $featured_image;
	$sql = "SELECT * FROM posts WHERE id=$role_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$post = mysqli_fetch_assoc($result);
	$title = $post['title'];
	$body = $post['body'];
	$published = $post['published'];
	$featured_image = $post['image'];

	// get post topic
	$sql = "SELECT * FROM topics WHERE id=$role_id";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);
	$topic_id = $topic['id'];
	$topic_name = $topic['name'];
}

function updatePost($request_values) {
	global $conn, $errors, $post_id, $title, $featured_image, $topic_id, $body, $published;

	$title = esc($request_values['title']);
	$body = esc($request_values['body']);
	$post_id = esc($request_values['post_id']);
	$post_slug = makeSlug($title);

	// if topic value is changed
	if (isset($request_values['topic_id'])) {
		$topic_id = esc($request_values['topic_id']);
	}
	// if publish value is changed
	if (isset($request_values['publish'])) {
		$published = esc($request_values['publish']);
	}
	// if featured image is changed
	$featured_image = $_FILES['featured_image']['name'];
	$target = "../static/images/" . basename($featured_image);
	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		array_push($errors, "Failed to upload image. Please check file settings for your server");
	}
	

	if (empty($title)) { array_push($errors, "Post title is required"); }
	if (empty($body)) { array_push($errors, "Post body is required"); }
	
	// update post 
	if (count($errors) == 0) {
		$query = "UPDATE posts SET title='$title', slug='$post_slug', views=0, image='$featured_image', body='$body', published=$published, updated_at=now() WHERE id=$post_id;
					UPDATE post_topic SET topic_id=$topic_id WHERE post_id=$post_id;";
		if(mysqli_multi_query($conn, $query)) {
			$_SESSION['message'] = "Post updated successfully";
			header('location: posts.php');
			exit(0);
		}
		else{
			array_push($errors, "mysqli_error($conn)");
		}
	}
}

// delete blog post
function deletePost($post_id){
	global $conn;
	// first delete post from posts table with id 
	// delete post from post_topic 
	$sql = "DELETE FROM post_topic WHERE post_id=$post_id;
			DELETE FROM posts WHERE id=$post_id;";
	if (mysqli_multi_query($conn, $sql)) {
		$_SESSION['message'] = "Post successfully deleted";
		header("location: posts.php");
		exit(0);
	}
	else{
		array_push($errors, "mysqli_error($conn)");
		header("location: posts.php");
	}
}
?>