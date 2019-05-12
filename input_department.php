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
<h1>Check it out, you can input data to the [DEPARTMENT] table here:</h1>
<form action="input_department.php" method="POST">
	<label>Dept #: </label><input name="dept_no" required/><br>
	<label>Dept Name: </label><input name="dept_name" required/><br>
	<label>Dept Phone #: </label><input name="dept_phone_no" required/><br>
	<label>Location: </label><input name="location" required/><br>
	<label>Chairperson SSN: </label><input name="chairperson_ssn" required/><br>
	<input type="submit" />
</form>
<?php
if ($_POST["dept_no"] != "")
{
	// attempt to execute insertion query, return error if error found
	mysql_query("INSERT INTO DEPARTMENT VALUES('".$_POST["dept_no"]."', '".$_POST["dept_name"]."', '".$_POST["dept_phone_no"]."', '".$_POST["location"]."', '".$_POST["chairperson_ssn"]."');");
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM DEPARTMENT;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [DEPARTMENT].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Department #</th>";
		echo "<th>Department Name</th>";
		echo "<th>Department Phone #</th>";
		echo "<th>Location</th>";
		echo "<th>Chairperson SSN</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "DEPT_NO")."</td>";
			echo "<td>".mysql_result($result, $i, "DEPT_NAME")."</td>";
			echo "<td>".mysql_result($result, $i, "DEPT_PHONE_NO")."</td>";
			echo "<td>".mysql_result($result, $i, "LOCATION")."</td>";
			echo "<td>".mysql_result($result, $i, "CHAIRPERSON_SSN")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>