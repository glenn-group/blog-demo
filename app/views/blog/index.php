<html>
<head>
	<title>Welcome to the Glenn framework blog!</title>
	<base href="http://localhost/blog-demo/public/" />
</head>
<body>
<?php 
if(isset($_SESSION['notice'])){
	echo $_SESSION['notice'];
	$_SESSION['notice'] = null;
}
?>
<h1>Blog posts</h1>
<ul>
	<?php foreach ($posts as $post): ?>
	<form method="post" action="blog/<?php if(isset($post->id)) echo $post->id; ?>">
		<input type="hidden" value="<?php echo $post->id; ?>" name="myformid" /> 
		<input type="hidden" value="DELETE" name="_method"></input>
		<li><strong><?php if(isset($post->title)) echo $post->title ?>
		</strong> <?php if (isset($post->content)) echo $post->content ?>
		<input type="submit" value="Delete Post"></input>
	</form>	
		
	<a href ="blog/<?php echo $post->id; ?>/edit" value="Edit Post">Edit</a>
	<?php endforeach ?>
</ul>
<br/>
<a href="blog/new">Add new Post!</a><br/>
</body>
</html>