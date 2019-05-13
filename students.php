<!DOCTYPE html>
<html>
<head>
<title>Students</title>
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
<h1>Student Portal</h1>
<br>
<h2>Entering a course number below will list the sections of the course including the classrooms, meeting days and time, and the number of students enrolled in each section.</h2>
<form action="students.php" method="POST">
	<label>Course #:</label><input type="text" name="course_num" required/><br>
	<input type="submit" />
</form>
<br>
<?php
if ($_POST["course_num"] != "")
{
	$result = mysql_query("SELECT SECTION_NO, CLASSROOM, MEETINGDAYS, BEGINTIME, ENDTIME, COUNT(*) FROM SECTION, ENROLL WHERE COURSE_NUM = COURSE_NUMBER AND SECTION_NO = SECTION_NUMBER AND COURSE_NUM = '".$_POST["course_num"]."' GROUP BY SECTION_NO;", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No results for course #: '".$_POST["course_num"]."' found in database.";
	}
	else
	{
		echo "<h4>Results for course #: ".$_POST["course_num"]."</h4>";
		echo "<table>";
		echo "<tr>";
		echo "<th>Section #</th>";
		echo "<th>Classroom</th>";
		echo "<th>Meeting Days</th>";
		echo "<th>Begin Time</th>";
		echo "<th>End Time</th>";
		echo "<th># Students Enrolled</th>";
		echo "</tr>";
		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "SECTION_NO")."</td>";
			echo "<td>".mysql_result($result, $i, "CLASSROOM")."</td>";
			echo "<td>".mysql_result($result, $i, "MEETINGDAYS")."</td>";
			echo "<td>".mysql_result($result, $i, "BEGINTIME")."</td>";
			echo "<td>".mysql_result($result, $i, "ENDTIME")."</td>";
			echo "<td>".mysql_result($result, $i, "COUNT(*)")."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
?>
<h2>Entering a CWID below will list all courses the student took and the grades for those courses.</h2>
<form action="students.php" method="POST">
	<label>CWID:</label><input type="text" name="campuswideid" required/><br>
	<input type="submit" />
</form>
<br>
<?php
if ($_POST["campuswideid"] != "")
{
	$result = mysql_query("SELECT COURSE_NO, COURSE_TITLE, GRADE FROM COURSE, ENROLL WHERE COURSE_NO = COURSE_NUMBER AND CAMPUSWIDEID = '".$_POST["campuswideid"]."';", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "No results for CWID: '".$_POST["campuswideid"]."' found in database.";
	}
	else
	{
		echo "<h4>Results for CWID: ".$_POST["campuswideid"]."</h4>";
		echo "<table>";
		echo "<tr>";
		echo "<th>Course #</th>";
		echo "<th>Course Title</th>";
		echo "<th>Grade</th>";
		echo "</tr>";
		for($i = 0; $i < mysql_numrows($result); $i++)
		{
			echo "<tr>";
			echo "<td>".mysql_result($result, $i, "COURSE_NO")."</td>";
			echo "<td>".mysql_result($result, $i, "COURSE_TITLE")."</td>";
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