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
<h1>Check it out, you can input data to the [STUDENT] table here:</h1>
<form action="input_student.php" method="POST">
	<label>CWID: </label><input name="cwid" required/><br>
	<label>Student Name: </label><input name="student_name" required/><br>
	<label>Address: </label><input name="student_address" required/><br>
	<label>Phone #: </label><input name="student_phone" required/><br>
	<label>Major (Dept #): </label><input name="major" required/><br>
	<label>Minor (Dept #): </label><input name="minor"/><br>
	<input type="submit" />
</form>
<?php
if ($_POST["cwid"] != "")
{
	// attempt to execute insertion query, return error if error found
	$insert_query = "INSERT INTO STUDENT VALUES('".$_POST["cwid"]."', '".$_POST["student_name"]."', '".$_POST["student_address"]."', '".$_POST["student_phone"]."', '".$_POST["major"]."'";
	if($_POST["minor"] != "")
	{
		$insert_query = $insert_query.", '".$_POST["minor"]."');";
	}
	else
	{
		$insert_query = $insert_query.", NULL);";
	}
	mysql_query($insert_query);
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM STUDENT;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [STUDENT].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>CWID</th>";
		echo "<th>Student Name</th>";
		echo "<th>Address</th>";
		echo "<th>Phone #</th>";
		echo "<th>Major</th>";
		echo "<th>Minor</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "CWID")."</td>";
			echo "<td>".mysql_result($result, $i, "STUDENT_NAME")."</td>";
			echo "<td>".mysql_result($result, $i, "STUDENT_ADDRESS")."</td>";
			echo "<td>".mysql_result($result, $i, "STUDENT_PHONE")."</td>";
			echo "<td>".mysql_result($result, $i, "MAJOR")."</td>";
			echo "<td>".mysql_result($result, $i, "MINOR")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>