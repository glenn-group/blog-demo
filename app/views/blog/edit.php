<html>
<head>
	<title>Edit posts!</title>
	
</head>
<body>
<h1>Edit post</h1>


<form method="post" action="../">
	<input type="hidden" value="PUT" name="_method"></input>
    Title
	<br/>
	<input  type="text" name="post[title]" value="<?php echo $post->title; ?>"/>
	<br/>
	Content
	<br/>
	<textarea  cols="20" rows="10" name="post[content]">  <?php echo $post->content; ?> </textarea>
	<br/>
	<input type="submit" value ="Submit"></input>
</form>



<a href="../">Back to posts!</a>
</body>
</html>
