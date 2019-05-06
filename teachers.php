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
<a href="index.html">aww shit im not supposed to be here, take me back</a>
<h1>YOU'VE COME TO THA TEACHER PAGE. YOU BEST BE A TEACHER IF YOU HERE, FO' REAL!</h1>
<form action="teachers.php" method="POST">
Enter a professor's social security number:<input type="text" name="ssn" />
<input type="submit" />
</form>
<br>
<?php
if ($_POST["ssn"] != "")
{
	$result = mysql_query("SELECT * FROM PROFESSOR WHERE SSN='".$_POST["ssn"]."';", $link);
	
	if(mysql_numrows($result) == 0)
	{
		echo "SSN '".$_POST["ssn"]."' not found in database.";
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
		mysql_close($link);
		echo "</table>";
	}
}
?>
</body>
</html>