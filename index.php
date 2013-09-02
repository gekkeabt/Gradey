<?php
// Made By Ahmed Bakay 			//
// http://abakay.tk 			// 
// Version 2.5 					//
// See github for changelogs	//
ob_start();
//Database information and connection
$hostname = "localhost"; 
$username = "root";
$password = "usbw";
$database = "grades";
$connect=mysqli_connect($hostname,$username,$password,$database);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//List of subjects
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
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
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
	padding-top:15px;
	margin-bottom:50px;
	text-align:center;
	color:white;
	position:fixed;
    top:0;
    width:100%;
    z-index:100;
}
.add-title{
	background-color:#1ABC9C;
	padding:16px;
	font-size:30px;
	font-weight:700;
	-webkit-box-shadow: 1px 0px 25px rgba(50, 50, 50, 0.77);
	-moz-box-shadow:    1px 0px 25px rgba(50, 50, 50, 0.77);
	box-shadow:         1px 0px 25px rgba(50, 50, 50, 0.77);
}
.add-content{
	background-color:#ECF0F1;
	color: #333333;
	padding:16px;
	font-size:30px;
	-webkit-box-shadow: 1px 0px 25px rgba(50, 50, 50, 0.77);
	-moz-box-shadow:    1px 0px 25px rgba(50, 50, 50, 0.77);
	box-shadow:         1px 0px 25px rgba(50, 50, 50, 0.77);
}
#add-period{
	width:50px;
}
#add-grade, #add-weight{
	width:100px;
}
#add-submit{
	margin-bottom:9px;
}
#logo{
	width:35px;
	margin-bottom:8px;
	padding-right:10px;
}
form#send-grade{
	margin-left:auto;
	margin-right:auto;
	width:420px
}

#card-collection{
	width:700px;
	margin-left:auto;
	margin-right:auto;
	margin-top:100px;
}
.card{
	margin-left:auto;
	margin-right:auto;
	margin-top:20px;
	width:100%;
	color:white;
	-webkit-box-shadow: 0px 0px 75px rgba(50, 50, 50, 0.77);
	-moz-box-shadow:    0px 0px 75px rgba(50, 50, 50, 0.77);
	box-shadow:         0px 0px 75px rgba(50, 50, 50, 0.77);
}
.card-title{
	padding:15px 15px 1px 15px;
	background-color:#ECF0F1;
	color: #333333;
	font-weight:700;
}
.card-content{
	background-color:#ffffff;
	color: #333333;
	padding:15px;
	font-size:15px;
}
.card-weight{
	font-size:14px;
	color:#00A1CB;
	font-weight:700;
}
.card-grade:hover{
	background-color:#E54028;
}
.card-grade{
	margin:7.5px;
	background-color:#ECF0F1;
	color:#333333;
}
.calc{
	margin-top:10px;
}
#calc-weight,#calc-average{
	width:60px;
}
#calc-submit{
	margin-bottom:9px;
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
	color:#E94007;
.period-select{
}
.period-select:hover{
	color:#E2DF9A;
}
#footer{
	margin-top:10px;
}
.overall{
	display:none;
}
</style>
<?php
// Include and create checking class for mobile device
require_once 'inc/mobile.php';
$detect = new Mobile_Detect;
 
// Detect if user is using a mobile device
if ( $detect->isMobile() ) {
	echo "
	
	<style>
	.add{
		width:100%;
		background-color:#ECF0F1;
		padding-bottom:10px;
		border-bottom:solid 5px #333;
		-webkit-box-shadow: 0px 0px 50px rgba(50, 50, 50, 0.77);
		-moz-box-shadow:    0px 0px 50px rgba(50, 50, 50, 0.77);
		box-shadow:         0px 0px 50px rgba(50, 50, 50, 0.77);
	}
	.add-title{
		display:none;
	}
	.add-content{
		width:100%;
		-webkit-box-shadow: 0px 0px 0px;
		-moz-box-shadow:    0px 0px 0px;
		box-shadow:         0px 0px 0px;
		background-color:transparent;
	}
	#card-collection{
		width:100%;
		margin-top:125px;
	}
	.card{	
		-webkit-box-shadow: 0px 0px 0px rgba(50, 50, 50, 0.77);
		-moz-box-shadow:    0px 0px 0px rgba(50, 50, 50, 0.77);
		box-shadow:         0px 0px 0px rgba(50, 50, 50, 0.77);
	}
	.card-title{
		color:#333333;
	}
	.card-content{
		background-color:white;
	}
	#add-subject{
		width:74%;
		margin-bottom:15px;
	}
	#add-period{
		margin-bottom:14px;
	}
	.btn-group a{
		font-size:5px;
	}
	</style>";
}
?></head>
<body onunload="unloadP('UniquePageNameHereScroll')" onload="loadP('UniquePageNameHereScroll')">
<!-- Place where the add bar is shown -->
<div class="add">
<span class="add-title">
<img id="logo" src="inc/logo.png" alt="Logo" />ADD GRADE
</span>
<span class="add-content">
<form id="send-grade" method="POST" style="display:inline;">
<select id="add-period" name="add-period">
	<option value="1" selected="selected">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
</select>
<select id="add-subject" name="add-subject">
    <option value="0" selected="selected" >Choose subject</option>
    <?php
	//Load the subjects
	foreach ($subjectcodes as $key=>$value) {
		echo "<option value=" . $key . ">" . $value . "</option>";
	}
	?>
</select>
<input id="add-grade" type="text" name="add-grade" placeholder="Your grade"/>
<input id="add-weight" type="text" name="add-weight" placeholder="Weight"/>
<input id="add-submit" type="submit" value="Add" class="btn btn-inverse"/>
</form>
</span>
<?php
//Code to add a grade
if(isset($_POST["add-subject"]) && isset($_POST["add-grade"]) && isset($_POST["add-weight"])){
	if($_POST["add-subject"]=="0" or $_POST["add-grade"]=="" or $_POST["add-weight"]==""){
		echo "<p align=\"center\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"We are not set yet...\"></p>";
		header('Refresh: 1.5; url=?'. $_GET["period"] .'');
	}else{
		$grade = $_POST["add-grade"];
		$grade = str_replace(',', '.', $grade);
		mysqli_query($connect,"INSERT INTO grades (period, subject, grade, weight)
		VALUES (" . $_POST["add-period"] . "," . $_POST["add-subject"] . "," . $grade . "," . $_POST["add-weight"] . ")");
		header('Location: ?period='. $_GET["period"] .'');
	}
}
?>
</div>
<!-- Place where all the grades are shown -->
<div id="card-collection">
<?php
$countsubjects = mysqli_query($connect,"SELECT DISTINCT subject FROM grades");
while($row = $countsubjects->fetch_assoc()){
	$subjectid = $row["subject"];
	$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' AND period='" . $_GET["period"] . "'") or die(mysql_error());  
	if($result->num_rows>0){	
?>
<div class="card">
<div class="card-title">
<?php
echo $subjectcodes[$subjectid];
//Display average and total grades
$result = mysqli_query($connect,"SELECT * FROM grades WHERE subject='$subjectid' AND period='" . $_GET["period"] . "' ");
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
//The formula for calculation
if(isset($_POST["calculate"])&&isset($_POST["calc-weight"])&&isset($_POST["calc-average"])){
	if(!$_POST["calculate"]==""&&!$_POST["calc-weight"]==""&&!$_POST["calc-average"]==""){
		if($_POST["calculate"]==$subjectid){
		$a = $_POST["calc-weight"];
		$y = $_POST["calc-average"];
		$q = $weights;
		$z = $average;
		// x = Grade to get the average you want
		// y = Average you want to have
		// z = Current Average
		// q = Total weight of current average
		// a = Weight of the test you will get
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
<form class="calc" method="POST" action="index.php?period=<?php echo $_GET["period"]; ?>">
<input id="calc-average" type="text" name="calc-average" placeholder="Goal"/>
<input id="calc-weight" type="text" name="calc-weight" placeholder="Weight"/>
<input id="calc-subject" type="hidden" name="calculate" value="<?php echo $subjectid;?>" />
<input type="submit" id="calc-submit" value="Calculate" class="btn btn-inverse">
</form>
</div>
<div class="card-content">
<?php
//Code to get grades and display them
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' AND period='" . $_GET["period"] . "' ") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn card-grade\" href=\"?remove=". $row["id"] . "&period=" . $_GET["period"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"card-weight\"> ".$row['weight'] . "</span></a>";
}
//Code to delete chosen grade
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?period=' . $_GET["period"] . '');
	echo $_GET["remove"];
}
?>
</div>
</div>
<?php }} ?>
</div>
<div id="card-collection" class="overall">
<?php
if(!isset($_GET["period"])){
	header('Location: ?period=1');
}elseif($_GET["period"]=="overall"){
	echo "<style>.overall{display:block;}</style>";
}

$countsubjects = mysqli_query($connect,"SELECT DISTINCT subject FROM grades");
while($row = $countsubjects->fetch_assoc()){
	$subjectid = $row["subject"];
	$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid'") or die(mysql_error());  
	if($result->num_rows>0){	
?>
<div class="card">
<div class="card-title">
<?php
echo $subjectcodes[$subjectid];
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
//The formula for calculation
if(isset($_POST["calculate"])&&isset($_POST["calc-weight"])&&isset($_POST["calc-average"])){
	if(!$_POST["calculate"]==""&&!$_POST["calc-weight"]==""&&!$_POST["calc-average"]==""){
		if($_POST["calculate"]==$subjectid){
		$a = $_POST["calc-weight"];
		$y = $_POST["calc-average"];
		$q = $weights;
		$z = $average;
		// x = Grade to get the average you want
		// y = Average you want to have
		// z = Current Average
		// q = Total weight of current average
		// a = Weight of the test you will get
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
<form class="calc" method="POST" action="index.php?period=<?php echo $_GET["period"]; ?>">
<input id="calc-average" type="text" name="calc-average" placeholder="Goal"/>
<input id="calc-weight" type="text" name="calc-weight" placeholder="Weight"/>
<input id="calc-subject" type="hidden" name="calculate" value="<?php echo $subjectid;?>" />
<input type="submit" id="calc-submit" value="Calculate" class="btn btn-inverse">
</form>
</div>
<div class="card-content">
<?php
//Code to get grades and display them
$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid'") or die(mysql_error());  
while($row = $result->fetch_assoc()){
	echo "<a class=\"btn card-grade\" href=\"?remove=". $row["id"] . "&period=" . $_GET["period"] . "\" title='" . $row["date"] . "' onclick=\"
		if (confirm('Are you sure you want to delete this grade?')) {
			window.location ='?remove=" . $row["id"] . "';
		} else {
			return false;
		}
	\">   " . $row['grade']." <span class=\"card-weight\"> ".$row['weight'] . "</span></a>";
}
//Code to delete chosen grade
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?period=' . $_GET["period"] . '');
	echo $_GET["remove"];
}
?>
</div>
</div>
<?php }} ?>
</div>
<div id="footer">
<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-inverse" href="?period=1">Period 1</a>
		<a class="btn btn-inverse" href="?period=2">Period 2</a>
		<a class="btn btn-inverse" href="?period=3">Period 3</a>
		<a class="btn btn-inverse" href="?period=4">Period 4</a>
    </div>
</div>
<a class="btn btn-inverse" href="?period=overall">Overall</a><br><br>
Proudly made by <a href="http://abakay.tk" target="_blank">Ahmed Bakay</a>
</div>
</body>
</html>
<script src="inc/bootstrap.min.js"></script>
<script src="inc/jquery-1.8.3.min.js"></script>
<script src="inc/bootstrap-select.js"></script>
<script src="inc/application.js"></script>
<script>
function getScrollXY() {
    var x = 0, y = 0;
    if( typeof( window.pageYOffset ) == 'number' ) {
        x = window.pageXOffset;
        y = window.pageYOffset;
    } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
        x = document.body.scrollLeft;
        y = document.body.scrollTop;
    } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
        x = document.documentElement.scrollLeft;
        y = document.documentElement.scrollTop;
    }
    return [x, y];
}
           
function setScrollXY(x, y) {
    window.scrollTo(x, y);
}
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function loadP(pageref){
	x=readCookie(pageref+'x');
	y=readCookie(pageref+'y');
	setScrollXY(x,y)
}
function unloadP(pageref){
	s=getScrollXY()
	createCookie(pageref+'x',s[0],0.1);
	createCookie(pageref+'y',s[1],0.1);
}
</script>