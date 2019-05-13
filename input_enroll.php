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
<h1>Check it out, you can input data to the [ENROLL] table here:</h1>
<form action="input_enroll.php" method="POST">
	<label>Course #: </label><input name="course_number" required/><br>
	<label>Section #: </label><input name="section_number" required/><br>
	<label>CWID: </label><input name="campuswideid" required/><br>
	<label>Grade: </label><select name="grade" required/>
		<option value="A+">A+</option>
		<option value="A">A</option>
		<option value="A-">A-</option>
		<option value="B+">B+</option>
		<option value="B">B</option>
		<option value="B-">B-</option>
		<option value="C+">C+</option>
		<option value="C">C</option>
		<option value="C-">C-</option>
		<option value="D+">D+</option>
		<option value="D">D</option>
		<option value="D-">D-</option>
		<option value="F">F</option>
	</select>
	<br>
	<input type="submit" />
</form>
<?php
if ($_POST["course_number"] != "")
{
	// attempt to execute insertion query, return error if error found
	mysql_query("INSERT INTO ENROLL VALUES('".$_POST["course_number"]."', '".$_POST["section_number"]."', '".$_POST["campuswideid"]."', '".$_POST["grade"]."');");
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM ENROLL;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [ENROLL].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Course #</th>";
		echo "<th>Section #</th>";
		echo "<th>CWID</th>";
		echo "<th>Grade</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "COURSE_NUMBER")."</td>";
			echo "<td>".mysql_result($result, $i, "SECTION_NUMBER")."</td>";
			echo "<td>".mysql_result($result, $i, "CAMPUSWIDEID")."</td>";
			echo "<td>".mysql_result($result, $i, "GRADE")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>