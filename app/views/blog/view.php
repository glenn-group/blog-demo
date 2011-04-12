<html>
<head>
	<title>Edit post!</title>
	<base href="http://localhost/blog-demo/public/blog/view" />
</head>
<body>
<?php

echo post['title'];

?>

<h1>Edit blog post</h1>

<form method="post" action="">
    Title
	<br/>
        <input name="post[id]" type=hidden value = "<?= $post['id'] ?>"/>
	<input  type="text" name="post[title]" />
	<br/>
	Content
	<br/>	
	<textarea  cols="20" rows="10" name="post[content]" > </textarea>
	<br/>
	<input type="submit" value ="Submit"></input>
</form>


<a href="../">Back to Posts!</a>
</body>
</html>
