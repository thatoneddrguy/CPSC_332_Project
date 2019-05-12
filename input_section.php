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
<h1>Check it out, you can input data to the [SECTION] table here:</h1>
<form action="input_section.php" method="POST">
	<label>Course #: </label><input name="course_no" required/><br>
	<label>Section #: </label><input name="section_no" required/><br>
	<label>Classroom: </label><input name="classroom" required/><br>
	<label># of Seats: </label><input name="number_of_seats" required/><br>
	<label>Meeting Days: </label><input name="meetingdays" required/><br>
	<label>Begin Time: </label><input name="begintime" required/><br>
	<label>End Time: </label><input name="endtime" required/><br>
	<label>Professor SSN: </label><input name="professor_ssn" required/><br>
	<input type="submit" />
</form>
<?php
if ($_POST["course_no"] != "")
{
	// attempt to execute insertion query, return error if error found
	mysql_query("INSERT INTO SECTION VALUES('".$_POST["course_no"]."', '".$_POST["section_no"]."', '".$_POST["classroom"]."', '".$_POST["number_of_seats"]."', '".$_POST["meetingdays"]."', '".$_POST["begintime"]."', '".$_POST["endtime"]."', '".$_POST["professor_ssn"]."');");
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM SECTION;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [SECTION].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Course #</th>";
		echo "<th>Section #</th>";
		echo "<th>Classroom</th>";
		echo "<th># of Seats</th>";
		echo "<th>Meeting Days</th>";
		echo "<th>Begin Time</th>";
		echo "<th>End Time</th>";
		echo "<th>Professor SSN</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "COURSE_NUM")."</td>";
			echo "<td>".mysql_result($result, $i, "SECTION_NO")."</td>";
			echo "<td>".mysql_result($result, $i, "CLASSROOM")."</td>";
			echo "<td>".mysql_result($result, $i, "NUMBER_OF_SEATS")."</td>";
			echo "<td>".mysql_result($result, $i, "MEETINGDAYS")."</td>";
			echo "<td>".mysql_result($result, $i, "BEGINTIME")."</td>";
			echo "<td>".mysql_result($result, $i, "ENDTIME")."</td>";
			echo "<td>".mysql_result($result, $i, "PROFESSOR_SSN")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>