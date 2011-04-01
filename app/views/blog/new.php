<html>
<head>
	<title>Add new posts!</title>
	<base href="http://localhost/blog-demo/public/blog/new" />
</head>
<body>
<h1>Create new blog post</h1>

<form method="post" action="">
    Title
	<br/>
	<input  type="text" name="post[title]" />
	<br/>
	Content
	<br/>	
	<textarea  cols="20" rows="10" name="post[content]" > </textarea>
	<br/>
	<input type="submit" value ="Submit"/>
</form>


<a href="../">Back to posts!</a>
</body>
</html>
