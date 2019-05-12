<!DOCTYPE html>
<html>
<head>
<title>Secret Input Page</title>
<link rel="stylesheet" href="include/styles.css">
<?php
$username = 'cs332s17';
$link = mysql_connect('mariadb', $username, 'atheiV0b');
if(!$link)
{
	die("<!--Could not connect: ".mysql_error()."-->");
}
echo "<!--Connected successfully.-->";
mysql_select_db($username, $link);
?>
</head>
<body>
<a href="index.html">aww shit im not supposed to be here, take me back</a>
<h1>Check it out, you can input data to the PROFESSOR table here:</h1>
<form action="input_professor.php" method="POST">
	SSN: <input name="SSN" />
	<input type="submit" />
</form>
</body>
</html>