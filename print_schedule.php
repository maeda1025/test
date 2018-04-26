<head>
<link rel="stylesheet" type="text/css" href="./css/print.css">
</head>

<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/functions_db.php");

$location = $_GET['location'];
$days = $_GET['days'];
$day1 = $_GET['day1'];
$course_code = $_GET['course_code'];
$course_name = $_GET['course_name'];
$inst_name = $_GET['inst_name'];
$vendor = $_GET['vendor'];

connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

//日程抽出--------------------------------------------------
$cal_days = get_days($day1,$days);
 $i=0;
 foreach($cal_days as $value){
  $day_last = $cal_days[$i];
  $i++;
 }

 $day1_ = date('m/d',strtotime($day1));
 $day_last_ = date('m/d',strtotime($day_last));

 if($day1_==$day_last_){
	$day = $day1_;
 }
 else{
 	$day = $day1_."  -  ".$day_last_;
 }
//--------------------------------------------------------

//講師名変更-----------------------------------------------
 if($vendor=='SAP'){
	$inst_name = 'SAP Education';
 }
 elseif($inst_name=='外部講師' or $inst_name==''){
        $inst = '';
 }
 else{  }
//-------------------------------------------------------

echo "<div class='no_print' style='position:fixed; top:10px;'>";
		echo "<b>Default Font-Size: 41pt</b><br>";
       for($i=20;$i<=60;$i++){
                echo '<a href="#" onclick="document.getElementsByTagName('."'textarea')[0].style.fontSize='".$i."pt';return false;".'">'.$i.'pt</a><br>';
        }


echo "</div>";

echo "<div class=content-print>";

echo "<div class=container>";
echo "<div class=print_block_0>".$location."</div>";
echo "<div class=print_block_1><input type='text' size=100% value='".$day."'></input></div>";
echo "<div class=print_block_2><input type='text' size=100% value='".$course_code."'></input></div>";
echo "<div class=print_block_3><textarea name='' rows='' cols='' wrap='soft' align='justify'>".$course_name."</textarea></div>";
echo "<div class=print_block_4><input type='text' size=100% value='".$inst_name."'></input></div>";

// if($link_check_answer=='ok'){
// 	echo "<div class=print_block_5>".get_logo($vendor_logo.'.png')."</div>";
// }
// else{echo "<div class=print_block_5>".$vendor_logo."</div>";}

echo "<div class=print_block_5>".$vendor."</div>";

echo "</div>";

echo "</html></body>";

?>
