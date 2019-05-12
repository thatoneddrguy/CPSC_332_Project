<!DOCTYPE html>
<html>
<head>
<title>Execute SQL</title>
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
<object id="secret_menu" data="include/secret_menu.html" rel="import">
Your browser doesn't support the object tag.
</object>
<h1>Execute SQL</h1>
<br>
<form action="exec_sql.php" method="POST">
	Enter an SQL query to run:<input type="text" name="sql_query" />
	<input type="submit" />
</form>
<br>
<?php
if ($_POST["sql_query"] != "")
{
	$query = mysql_query($_POST["sql_query"], $link);
	
	echo "<table>";
	echo "<tr>";
	for($i = 0; $i < mysql_num_fields($query); $i++)
	{
		$values=mysql_field_name($query,$i);
		echo "<th>$values</th>";
	}
	echo "</tr>";
	while($row = mysql_fetch_row($query))
	{
		echo "<tr>";

		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			echo "<td>$cell</td>";

		echo "</tr>\n";
	}
	echo "</table>";
}
mysql_close($link);
?>
</body>
</html>