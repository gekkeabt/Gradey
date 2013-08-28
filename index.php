<?php
ob_start();
$hostname = "localhost"; 
$username = "your_username";
$password = "you_password";
$database = "grades";
$connect=mysqli_connect($hostname,$username,$password,$database);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Grades Manager</title>
<link href="inc/bootstrap.css" rel="stylesheet">
<link href="inc/flat-ui.css" rel="stylesheet">
<style>
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Open Sans'), local('OpenSans'), url(http://themes.googleusercontent.com/static/fonts/opensans/v6/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 600;
  src: local('Open Sans Semibold'), local('OpenSans-Semibold'), url(http://themes.googleusercontent.com/static/fonts/opensans/v6/MTP_ySUJH_bn48VBG8sNSnhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 700;
  src: local('Open Sans Bold'), local('OpenSans-Bold'), url(http://themes.googleusercontent.com/static/fonts/opensans/v6/k3k702ZOKiLJc3WVjuplzHhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}
*{
	margin:0px;
}
body{
	background-color:#2C3E50;
	font-family: 'Open Sans', sans-serif;
}
.add{
	margin-top:25px;
	margin-left:auto;
	margin-right:auto;
	width:98%;
	background-color:#34495E;
	-webkit-box-shadow: 1px 0px 25px rgba(50, 50, 50, 0.77);
	-moz-box-shadow:    1px 0px 25px rgba(50, 50, 50, 0.77);
	box-shadow:         1px 0px 25px rgba(50, 50, 50, 0.77);
	text-align:center;
	color:white;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
.add-title{
	background-color:#1ABC9C;
	-webkit-border-top-left-radius: 10px;
	-webkit-border-top-right-radius: 10px;
	-moz-border-radius-topleft: 10px;
	-moz-border-radius-topright: 10px;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	padding:15px;
	font-size:50px;
	font-weight:700;
}
.add-content{
	background-color:#ECF0F1;
	color: #333333;
	-webkit-border-bottom-right-radius: 10px;
	-webkit-border-bottom-left-radius: 10px;
	-moz-border-radius-bottomright: 10px;
	-moz-border-radius-bottomleft: 10px;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
	padding:15px;
	font-size:20px;
}
form#send-grade{
	margin-left:auto;
	margin-right:auto;
	width:420px
}
#logo{
	width:35px;
	margin-bottom:8px;
	padding-right:10px;
}
#card-collection{
	width:75%;
	margin-left:auto;
	margin-right:auto;
	margin-top:20px;
}
.card{
	margin-left:auto;
	margin-right:auto;
	margin-top:20px;
	width:100%;
	color:white;
}
.card-title{
	padding:10px;
	background-color:#1ABC9C;	
	-webkit-border-top-left-radius: 10px;
	-webkit-border-top-right-radius: 10px;
	-moz-border-radius-topleft: 10px;
	-moz-border-radius-topright: 10px;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	font-weight:700;
}
.card-content{
	background-color:#ECF0F1;
	color: #333333;
	-webkit-border-bottom-right-radius: 10px;
	-webkit-border-bottom-left-radius: 10px;
	-moz-border-radius-bottomright: 10px;
	-moz-border-radius-bottomleft: 10px;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
	padding:15px;
	font-size:15px;
}
.list{
	margin-left:10px;
	margin-right:10px;
}
.weight-font{
	font-size:10px;
	color:#333333;
}
.grade-object{
	margin:7.5px;
}
#footer{
	margin-top:15px;
	margin-bottom:15px;
	color:white;
	width:100%;
	text-align:center;
}
#footer a{
	text-decoration:none;
}
</style>
</head>
<body>
<div class="add">
<div class="add-title">
<img id="logo" src="inc/logo.png" alt="Logo" />ADD GRADE
</div>
<div class="add-content">
Fill in the boxes to add your grade<br><br>
<form id="send-grade" type="GET">
<select name="herolist" class="select-block">
    <option value="0" selected="selected" >Choose subject</option>
    <option value="1">Mathematics</option>
    <option value="2">Physics</option>
    <option value="3">Chemistry</option>
    <option value="4">Biology</option>
    <option value="5">English</option>
    <option value="6">Dutch</option>
    <option value="7">German</option>
    <option value="8">Sociology</option>
    <option value="9">Physical Education</option>
    <option value="10">Art</option>
    <option value="11">General Science</option>
    <option value="12">Philosophy</option>
    <option value="13">Management and Organization</option>
    <option value="14">Research and Design</option>
</select>
<input type="text" name="grade" placeholder="Your grade"/>
<input type="text" name="weight" placeholder="Weight"/>
<input type="submit" class="btn btn-block btn-primary" value="Add Grade">
</form>
<?php
if(isset($_GET["herolist"]) && isset($_GET["grade"]) && isset($_GET["weight"])){
	if($_GET["herolist"]=="0" or $_GET["grade"]=="" or $_GET["weight"]==""){
		echo "<p align=\"center\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"We are not set yet...\"></p>";
		header('Refresh: 1.5; url=?');
	}else{
		$grade = $_GET["grade"];
		$grade = str_replace(',', '.', $grade);
		mysqli_query($connect,"INSERT INTO grades (subject, grade, weight)
		VALUES (" .  $_GET["herolist"] . "," . $grade . "," . $_GET["weight"] . ")");
		header('Location: ?');
	}
}
?>
</div>
</div>

<!-- The place where a summary of grades will be shown -->
<div id="card-collection">


<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='1' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Mathematics
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='1'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='1' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list grade-object\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='2' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Physics
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='2'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='2' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='3' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Chemistry
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='3'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='3' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='4' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Biology
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='4'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='4' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='5' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
English
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='5'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='5' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='6' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Dutch
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='6'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='6' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='7' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
German
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='7'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='7' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='8' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Sociology
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='8'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='8' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='9' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Physical Education
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='9'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='9' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='10' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Art
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='10'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='10' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='11' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
General Science
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='11'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='11' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='12' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Philosophy
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='12'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='12' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='13' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Management and Organization
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='13'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='13' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='14' ") or die(mysql_error());  
if($result->num_rows>0):
?>
<div class="card">
<div class="card-title">
Research and Design
<?php
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='14'");
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
	$summing= $row['grade'] * $row['weight'];
	$grades += $summing;
	$weights += $row['weight'];
}	
$average = $grades / $weights;
echo '| Average: ', round($average, 1) , ' | ';
echo $result->num_rows, ' Grades' ;
?>
</div>
<div class="card-content">
<?php
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='14' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn btn-primary list\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php endif; ?>

<div id="footer">Proudly made by <a href="http://abakay.tk" target="_blank">Ahmed Bakay</a></div>
</div>
</body>
</html>
<script src="inc/jquery-1.8.3.min.js"></script>
<script src="inc/bootstrap.min.js"></script>
<script src="inc/bootstrap-select.js"></script>
<script src="inc/application.js"></script>

