<html>
<head>
	<title>Users!</title>
	<base href="http://localhost/blog-demo/public/" />
</head>
<body>
<?php 
if(isset($_SESSION['notice'])){
	echo $_SESSION['notice'];
	$_SESSION['notice'] = null;
}
?>
<h1>Lists of users</h1>
<ul>
	<?php foreach ($users as $user): ?>
	<form method="post" action="user/<?php if(isset($user->username)) echo $user->username; ?>">
		<input type="hidden" value="<?php echo $user->username; ?>" name="userform" /> 
		<input type="hidden" value="DELETE" name="_method"></input>
		<li><strong><?php if(isset($user->username)) echo $user->username ?>
		<input type="submit" value="Delete User"></input>
	</form>		
	<a href ="user/<?php echo $user->username; ?>/edit" value="Edit user">Edit</a>
	<?php endforeach ?>
</ul>
<br/>
<a href="user/new">Add new user!</a><br/>
</body>
</html>