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
<h1>Check it out, you can input data to any of our awesome tables here:</h1>
<form action="input_database_data.php" method="POST">
	<select id="table" onchange="tableChange()">
		<option value="professor">Professor</option>
		<option value="professor_degrees">Professor_Degrees</option>
	</select>
	<input type="submit" />
</form>
</body>
</html>