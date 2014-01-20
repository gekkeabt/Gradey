<?php
// Made By Ahmed     			//
// http://abakay.tk 			// 
// Version 3.0 					//
// See github for changelogs	//
ob_start();
//Database information and connection//
$hostname = "localhost"; 
$username = "root";
$password = "password";
$database = "grades";
$connect=mysqli_connect($hostname,$username,$password,$database);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//List of subjects
$subjectcodes[1] = "Nederlands";
$subjectcodes[2] = "Engels";
$subjectcodes[3] = "Duits";
$subjectcodes[4] = "Maatschappijleer";
$subjectcodes[5] = "LO";
$subjectcodes[6] = "CKV";
$subjectcodes[7] = "ANW";
$subjectcodes[8] = "Levensbeschouwing";
$subjectcodes[9] = "Rekentoets";
$subjectcodes[91] = "Wiskunde";
$subjectcodes[92] = "Natuurkunde";
$subjectcodes[93] = "Scheikunde";
$subjectcodes[94] = "Biologie";
$subjectcodes[95] = "M&O";
$subjectcodes[96] = "O&O";


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

//Code to delete chosen grade
if(isset($_GET["remove"])){
	mysqli_query($connect, "DELETE FROM grades WHERE id='". $_GET["remove"] ."'");
	header('Location: ?period=' . $_GET["period"] . '');
	echo $_GET["remove"];
}



?>