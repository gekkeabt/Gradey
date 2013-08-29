<?php
// Made By Ahmed Bakay 			//
// http://abakay.tk 			// 
// Version 1.3 					//
// See github for changelogs	//
ob_start();
$hostname = "localhost"; 
$username = "user_name";
$password = "user_password";
$database = "grades";
$connect=mysqli_connect($hostname,$username,$password,$database);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$subjectcodes[1] = "Mathematics";
$subjectcodes[2] = "Physics";
$subjectcodes[3] = "Chemistry";
$subjectcodes[4] = "Biology";
$subjectcodes[5] = "English";
$subjectcodes[6] = "Dutch";
$subjectcodes[7] = "German";
$subjectcodes[8] = "Sociology";
$subjectcodes[9] = "Physical Education";
$subjectcodes[10] = "Art";
$subjectcodes[11] = "General Science";
$subjectcodes[12] = "Philosophy";
$subjectcodes[13] = "Management and Organization";
$subjectcodes[14] = "Research and Design";

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
	color:white;
	font-family: 'Open Sans', sans-serif;
}
.add{
	margin-top:25px;
	margin-left:auto;
	margin-right:auto;
	width:60%;
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
	width:60%;
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
#textbox{
	height:10px;
	width:120px;
	margin-top:10px;
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
    <?php	
	foreach ($subjectcodes as $key=>$value) {
		echo "<option value=" . $key . ">" . $value . "</option>";
	}
	?>
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
$countsubjects = mysqli_query($connect,"SELECT DISTINCT subject FROM grades;");
while($row = $countsubjects->fetch_assoc()){
	$subjectid = $row["subject"];
	$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' ") or die(mysql_error());  
	if($result->num_rows>0){	
?>
<div class="card">
<div class="card-title">
<?php echo $subjectcodes[$subjectid]; ?>
<?php
//Display average and total grades
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='$subjectid'");
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
if(isset($_GET["calculate"])&&isset($_GET["calculate-weight"])&&isset($_GET["calculate-grade"])){
	if(!$_GET["calculate"]==""&&!$_GET["calculate-weight"]==""&&!$_GET["calculate-grade"]==""){
		if($_GET["calculate"]==$subjectid){
		$a = $_GET["calculate-weight"];
		$y = $_GET["calculate-grade"];
		$q = $weights;
		$z = $average;
		$tobe = (-($a*$y+$q*$y-$q*$z)/$a)*-1;
		if($tobe>10 or $tobe<0){
			echo " | Not possible yet";
		}else{
			echo " | The grade you need is: " . round($tobe,1);
		}
		}
	}
}
?>
<form type="GET" style='margin: 0; padding: 0'>
<input id="textbox" type="text" name="calculate-grade" placeholder="Desired Average"/>
<input id="textbox" type="text" name="calculate-weight" placeholder="Weight"/>
<input type="hidden" name="calculate" value="<?php echo $subjectid;?>" />
<input type="submit" class="btn  btn-primary" value="Calculate">
</form>
</div>
<div class="card-content">
<?php
//Code to get grades and display them
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a id=\"gradeshow\" class=\"btn btn-primary list grade-object\" href=\"?remove=". $row["id"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"weight-font\"> ".$row['weight'] . "</span></a>";
}
//Code to delete chosen grade
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?');
	echo $_GET["remove"];
}
?>

</div>
</div>
<?php }} ?>
<div id="footer">Proudly made by <a href="http://abakay.tk" target="_blank">Ahmed Bakay</a></div>
</div>
</body>
</html>
<script src="inc/jquery-1.8.3.min.js"></script>
<script src="inc/bootstrap.min.js"></script>
<script src="inc/bootstrap-select.js"></script>
<script src="inc/application.js"></script>