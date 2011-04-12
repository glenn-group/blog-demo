<html>
<head>
	<title>Edit user</title>

</head>
<body>
<h1>Edit user</h1>


<form method="post" action="../">
    <input type="hidden" value="PUT" name="_method"></input>
    Username
	<br/>
	<input  type="text" name="user[username]" value="<?php echo $user->username; ?>"/>
	<br/>
	Password
	<br/>
	<input  type="text" name="user[password]" value="<?php echo $user->password; ?>"/>
	<br/>
	<input type="submit" value ="Submit"></input>
</form>



<a href="../">Back to posts!</a>
</body>
</html>
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of edit
 *
 * @author Nino
 */
class edit {
    //put your code here
}
?>
