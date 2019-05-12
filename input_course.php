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
<h1>Check it out, you can input data to the [COURSE] table here:</h1>
<form action="input_course.php" method="POST">
	<label>Course #: </label><input name="course_no" required/><br>
	<label>Course Title: </label><input name="course_title" required/><br>
	<label>Textbook: </label><input name="textbook" required/><br>
	<label>Units: </label><input type="number" name="units" min="1" max="9" required/><br>
	<label>Dept #: </label><input name="dept_num" required/><br>
	<input type="submit" />
</form>
<?php
if ($_POST["course_no"] != "")
{
	// attempt to execute insertion query, return error if error found
	mysql_query("INSERT INTO COURSE VALUES('".$_POST["course_no"]."', '".$_POST["course_title"]."', '".$_POST["textbook"]."', '".$_POST["units"]."', '".$_POST["dept_num"]."');");
	echo mysql_error($link)."\n";
	
	// display all results from table
	$result = mysql_query("SELECT * FROM COURSE;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No records in [COURSE].";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Course #</th>";
		echo "<th>Course Title</th>";
		echo "<th>Textbook</th>";
		echo "<th>Units</th>";
		echo "<th>Dept #</th>";
		echo "</tr>";

		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "COURSE_NO")."</td>";
			echo "<td>".mysql_result($result, $i, "COURSE_TITLE")."</td>";
			echo "<td>".mysql_result($result, $i, "TEXTBOOK")."</td>";
			echo "<td>".mysql_result($result, $i, "UNITS")."</td>";
			echo "<td>".mysql_result($result, $i, "DEPT_NUM")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>