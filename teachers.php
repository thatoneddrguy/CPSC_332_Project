<!DOCTYPE html>
<html>
<head>
<title>Teachers</title>
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
<a href="index.html">Home</a>
<h1>Teacher Portal</h1>
<br>
<h2>Entering a professor's social security number below will list the titles, classrooms, meeting days and time of his/her classes.</h2>
<form action="teachers.php" method="POST">
	Enter a professor's social security number:<input type="text" name="ssn" />
	<input type="submit" />
</form>
<br>
<?php
if ($_POST["ssn"] != "")
{
	$result = mysql_query("SELECT COURSE_TITLE, CLASSROOM, MEETINGDAYS, BEGINTIME, ENDTIME FROM COURSE, SECTION, PROFESSOR WHERE PROFESSOR_SSN = SSN AND COURSE_NO = COURSE_NUM AND PROFESSOR_SSN = '".$_POST["ssn"]."';", $link);
	//$result = mysql_query("SELECT * FROM PROFESSOR WHERE SSN='".$_POST["ssn"]."';", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "SSN '".$_POST["ssn"]."' not found in database.";
	}
	else
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Course Title</th>";
		echo "<th>Classroom</th>";
		echo "<th>Meeting Days</th>";
		echo "<th>Begin Time</th>";
		echo "<th>End Time</th>";
		echo "</tr>";
		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "COURSE_TITLE")."</td>";
			echo "<td>".mysql_result($result, $i, "CLASSROOM")."</td>";
			echo "<td>".mysql_result($result, $i, "MEETINGDAYS")."</td>";
			echo "<td>".mysql_result($result, $i, "BEGINTIME")."</td>";
			echo "<td>".mysql_result($result, $i, "ENDTIME")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
mysql_close($link);
?>
</body>
</html>