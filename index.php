<?php
// Made By Ahmed                //
// http://abakay.tk             // 
// Version 3.0                  //
// See github for changelogs    //
include("config.php");
if(!isset($_GET["period"])){
    header('Location: ?period=overall');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Gradey</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<link href="inc/s.min.css" rel="stylesheet">
<link href="inc/style.css" rel="stylesheet">
<link rel="stylesheet" href="inc/jquery.notifyBar.css">
<script src="inc/jquery.notifyBar.js"></script>
</head>
<body onunload="unloadP('UniquePageNameHereScroll')" onload="loadP('UniquePageNameHereScroll')">



<div class="login">
    <div class="login-center">
    <form class="login-form" method="POST" action="#">
        <h1>Login</h1>
        
<!-- Place where the user has to login -->
<?php
if(isset($_COOKIE["un"])){
    echo "<script>$(\".login-form\").fadeOut(0);</script>";
    echo "<script>$(\".login\").fadeOut(750);</script>";
}else{
    if(isset($_POST["username"])&&isset($_POST["password"])){
    if($_POST["username"]=="admin"&&$_POST["password"]=="admin"){
            $inTwoMonths = 60 * 60 * 24 * 60 + time(); 
            setcookie('un', $_POST["username"], $inTwoMonths);
            header('Location: ?period=overall');
    }else{
    echo "<p>Wrong password</p>";
    }
    }
}

if(isset($_GET["logout"])){
if($_GET["logout"]=="true"){
    setcookie("un", "", time()-3600);
}
}
?>
        
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>    
    </div>
</div>






<!-- Place where the add bar is shown -->
<div class=" add" id="trip-1">
    <span class="add-content">
    <form class="send-grade" method="POST">
    <select class="add-period" name="add-period">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
      <option value="3">3</option>
       <option value="4">4</option>
    </select>
    <select class="add-subject" name="add-subject">
        <option value="0" selected="selected" >Subject</option>
        <?php
        //Load the subjects
       foreach ($subjectcodes as $key=>$value) {
           echo "<option value=" . $key . ">" . $value . "</option>";
       }
       ?>
    </select>
    <input class="add-grade"  name="add-grade" placeholder="Grade"/>
    <input class="add-weight"  name="add-weight" placeholder="Weight"/>
    <input class="add-submit" type="submit" value="Add" class="btn btn-inverse"/>
    </form>
    </span>
</div>












<!-- Place where all the grades are shown -->
<div class="card-collection panel">
<?php
if($_GET["period"]=="overall"){
            $result = mysqli_query($connect, "SELECT * FROM grades") or die(mysql_error());  
        }else{
            $result = mysqli_query($connect, "SELECT * FROM grades WHERE period='" . $_GET["period"] . "'") or die(mysql_error());  
    }
    $grades = 0;
    $weights = 0;
    while($row = $result->fetch_assoc()){
        $summing= $row['grade'] * $row['weight'];
        $grades += $summing;
       $weights += $row['weight'];
    }   
    if($result->num_rows>0){
    $average = $grades / $weights;
}
if($_GET["period"]=="overall"){
$countsubjects = mysqli_query($connect,"SELECT DISTINCT subject FROM grades ORDER BY `subject` ASC");
}else{
$countsubjects = mysqli_query($connect,"SELECT DISTINCT subject FROM grades WHERE period='". $_GET["period"] . "' ORDER BY `subject` ASC");
}

    if($result->num_rows>0){
    while($row = $countsubjects->fetch_assoc()){
    $subjectid = $row["subject"];
    if($_GET["period"]=="overall"){
        $result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid'") or die(mysql_error());  
    }else{
        $result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' AND period='" . $_GET["period"] . "'") or die(mysql_error());  
    }   
?>

<div class="row">
<div class="small-3 columns">
<?php
echo "<div href=\"#\" data-reveal-id=\"calculate" .  $subjectid . "\" class=\"subjecttitle\">" . $subjectcodes[$subjectid] . "</div>";
?>
<?php
//The formula for calculation
//Display average and total grades
if($_GET["period"]=="overall"){
        $result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid'") or die(mysql_error());  
    }else{
        $result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' AND period='" . $_GET["period"] . "'") or die(mysql_error());  
    }
$grades = 0;
$weights = 0;
while($row = $result->fetch_assoc()){
    $summing= $row['grade'] * $row['weight'];
    $grades += $summing;
    $weights += $row['weight'];
}   
$average = $grades / $weights;


$result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid'") or die(mysql_error());
$grades2 = 0;
$weights2 = 0;
while($row = $result->fetch_assoc()){
    $summing2= $row['grade'] * $row['weight'];
    $grades2 += $summing2;
    $weights2 += $row['weight'];
}
$average2 = $grades2 / $weights2;
if(isset($_POST["calculate"])&&isset($_POST["calc-weight"])&&isset($_POST["calc-average"])){
    if(!$_POST["calculate"]==""&&!$_POST["calc-weight"]==""&&!$_POST["calc-average"]==""){
        if($_POST["calculate"]==$subjectid){
        $a = $_POST["calc-weight"];
        $y = $_POST["calc-average"];
        $q = $weights2;
        $z = $average2;
        // x = Grade to get the average you want
        // y = Average you want to have
        // z = Current Average
        // q = Total weight of current average
        // a = Weight of the test you will get
        $tobe = (-($a*$y+$q*$y-$q*$z)/$a)*-1;
        if($tobe>10 or $tobe<0){
            echo "<script>";
            echo "
    $.notifyBar({
        html:     \"<b>Not possible yet, sorry</b>\",
        cssClass: \"Appear at bottom\",
        position: \"bottom\",
        delay: \"15\"
    });";
            echo "</script>";
        }else{          
            
            echo "<script>";
            echo "
    $.notifyBar({
        html:     \"The grade you need is:<b> " . round($tobe,1) . "</b>\",
        cssClass: \"Appear at bottom\",
        position: \"bottom\",
        delay: \"15\"
    });";
            echo "</script>";
        }
        }
    }
}
?>
  <div class="progress 
  <?php
  if($average<5.5){
    echo 'alert';
}elseif($average>=5.6 && $average<6.5){
    echo '';
}elseif($average>=6.5){
    echo 'success';
}
?>
   radius ">
  <span class="meter" style="width: <?php echo $average*10; ?>%"><?php echo round($average,1);?></span>
</div>
</div>



<div id="calculate<?php echo $subjectid; ?>" class="reveal-modal small-centered calc-popup tiny" data-reveal>
    <h3>Calculation for: <?php echo $subjectcodes[$subjectid]; ?></h3>

    <br>
    <a class="close-reveal-modal">&#215;</a>
    <form class="calc" method="POST" action="index.php?period=<?php echo $_GET["period"]; ?>">
    <label>The average grade you desire</label>
    <input type="text" name="calc-average">
    <label>The weight of your next grade</label>
    <input type="text" name="calc-weight">
    <input type="hidden" name="calculate" value="<?php echo $subjectid;?>" />
    <input type="submit" class="calc-submit" value="Calculate">
</form>
</div>

    
    
<div class="small-9 columns card-grades row">

 <?php
//Code to get grades and display them
if($_GET["period"]=="overall"){
        $result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' ORDER BY `period` ASC") or die(mysql_error());  
    }else{
        $result = mysqli_query($connect, "SELECT * FROM grades WHERE subject='$subjectid' AND period='" . $_GET["period"] . "' ORDER BY `date` ASC") or die(mysql_error());  
    }
    while($row = $result->fetch_assoc()){
    if($_GET["period"]=="overall"){
        $grade_period = " - " . $row["period"];
    }else{
        $grade_period = "";
    }
    echo 
"<span class=\"card-collect\"><a class=\"card-grade\" title=\"" . $row["date"] . "\" onClick=\"if (confirm('Are you sure you want to delete this grade?')){
            window.location ='?period=" . $_GET["period"] . "&remove=" . $row["id"] . "'
        } else {
            return false;
        }
    \">   " . $row['grade']." <span class=\"card-weight\"> ".$row['weight'] . $grade_period . "</span></a></span>";
}
?>
</div>
</div>
<?php }}elseif($result->num_rows==0){
echo "<div class=\"row panel\">No grades to show here yet</div>";
    } ?>



<div class="footer row">
          <span class="small-12 columns" onclick="window.location='?period=1';"><br><b>Choose period</b><br><br></span>
        <button class="small-2 columns tiny" onclick="window.location='?period=1';">1</button>
        <button class="small-2 columns tiny" onclick="window.location='?period=2';">2</button>
        <button class="small-2 columns tiny" onclick="window.location='?period=3';">3</button>
        <button class="small-2 columns tiny" onclick="window.location='?period=4';">4</button>
        
        <button class="small-4 columns tiny" onclick="window.location='?period=overall';">Overall</button>
    <?php
    if($_GET["period"]=="overall"){
            $result = mysqli_query($connect, "SELECT * FROM grades") or die(mysql_error());  
        }else{
            $result = mysqli_query($connect, "SELECT * FROM grades WHERE period='" . $_GET["period"] . "'") or die(mysql_error());  
    }
    $grades = 0;
    $weights = 0;
    while($row = $result->fetch_assoc()){
        $summing= $row['grade'] * $row['weight'];
        $grades += $summing;
       $weights += $row['weight'];
    }   
    if($result->num_rows>0){
    $average = $grades / $weights;
    echo "<div class=\"small-4 columns\"> 
    Period average:<b> " . round($average,2) . "</b><br><br></div>";
    }
    ?>
    
<div class="small-4 columns logout"><a href="?logout=true">Log Out</a></div>
<div class="small-4 columns foot-note">Proudly made by <a href="#" target="_blank">Ahmed Bakay</a> </div>

</div>
</div>
</body>
</html>



<script src="inc/s.min.js"></script>
<script src="inc/jquery.notifyBar.js"></script>
<script>
    $(document).foundation();
</script>
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
    
    $(window).resize(function(){

    $('.login-form').css({
        position:'absolute',
        left: ($(window).width() - $('.login-form').outerWidth())/2,
        top: ($(window).height() - $('.login-form').outerHeight())/2
    });

});

// To initially run the function:
$(window).resize();
</script>