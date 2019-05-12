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
<h1>Check it out, you can input data to the [PROFESSOR] table here:</h1>
<form action="input_professor.php" method="POST">
	<label>SSN: </label><input name="ssn" required/><br>
	<label>Name: </label><input name="name" required/><br>
	<label>Telephone: </label><input name="telephone" required/><br>
	<label>Sex: </label>
		<label style="float:none;"><input type="radio" name="sex" value="M" checked>Male</label><br>
		<label style="float:none;"><input type="radio" name="sex" value="F" style="margin-left:125px;">Female</label><br>
	<label>Title: </label><input name="title" required/><br>
	<label>Salary: (#s only)</label><input name="salary" required/><br>
	<label>Address: </label><input name="address" required/><br>
	<input type="submit" />
</form>
<?php
if ($_POST["ssn"] != "")
{
	// attempt to execute insertion query, return error if error found
	mysql_query("INSERT INTO PROFESSOR VALUES('".$_POST["ssn"]."', '".$_POST["name"]."', '".$_POST["telephone"]."', '".$_POST["sex"]."', '".$_POST["title"]."', '".$_POST["salary"]."', '".$_POST["address"]."');");
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM PROFESSOR;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [PROFESSOR].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>SSN</th>";
		echo "<th>Name</th>";
		echo "<th>Telephone</th>";
		echo "<th>Sex</th>";
		echo "<th>Title</th>";
		echo "<th>Salary</th>";
		echo "<th>Address</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "SSN")."</td>";
			echo "<td>".mysql_result($result, $i, "NAME")."</td>";
			echo "<td>".mysql_result($result, $i, "TELEPHONE")."</td>";
			echo "<td>".mysql_result($result, $i, "SEX")."</td>";
			echo "<td>".mysql_result($result, $i, "TITLE")."</td>";
			echo "<td>".mysql_result($result, $i, "SALARY")."</td>";
			echo "<td>".mysql_result($result, $i, "ADDRESS")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>