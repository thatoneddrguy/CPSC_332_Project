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
<object id="secret_menu" data="include/secret_menu.html" rel="import">
Your browser doesn't support the object tag.
</object>
<h1>Check it out, you can input data to the [PREREQ] table here:</h1>
<form action="input_prereq.php" method="POST">
	<label>Course #: </label><input name="cnum" required/><br>
	<label>Prereq Course #: </label><input name="prereqcnum" required/><br>
	<input type="submit" />
</form>
<?php
if ($_POST["cnum"] != "")
{
	// attempt to execute insertion query, return error if error found
	mysql_query("INSERT INTO PREREQ VALUES('".$_POST["cnum"]."', '".$_POST["prereqcnum"]."');");
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM PREREQ;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [PREREQ].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Course #</th>";
		echo "<th>Prereq Course #</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "CNUM")."</td>";
			echo "<td>".mysql_result($result, $i, "PREREQCNUM")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>