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
<h1>Check it out, you can input data to the [PROFESSOR_DEGREES] table here:</h1>
<form action="input_professor_degrees.php" method="POST">
	<label>SSN: </label><input name="ssn" required/><br>
	<label>Degree Name: </label><input name="degreename" required/><br>
	<input type="submit" />
</form>
<?php
if ($_POST["ssn"] != "")
{
	// attempt to execute insertion query, return error if error found
	mysql_query("INSERT INTO PROFESSOR_DEGREES VALUES('".$_POST["ssn"]."', '".$_POST["degreename"]."');");
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM PROFESSOR_DEGREES;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [PROFESSOR_DEGREES].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>SSN</th>";
		echo "<th>Degree Name</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "PROF_SSN")."</td>";
			echo "<td>".mysql_result($result, $i, "DEGREENAME")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>