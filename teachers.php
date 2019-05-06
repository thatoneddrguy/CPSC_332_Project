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
<table>
	<tr>
		<th>SSN</th>
		<th>Name</th>
		<th>Telephone</th>
		<th>Sex</th>
		<th>Title</th>
		<th>Salary</th>
		<th>Address</th>
	</tr>
	<?php
	$result = mysql_query("SELECT * FROM PROFESSOR;", $link);
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
	?>
</table>
</body>
</html>