<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $current_name = htmlspecialchars($_POST["current_name"], ENT_QUOTES);
        $schedule_id = htmlspecialchars($_POST["schedule_id"], ENT_QUOTES);
        $vendor = htmlspecialchars($_POST["vendor"], ENT_QUOTES);
        $course_code = htmlspecialchars($_POST["course_code"], ENT_QUOTES);
        $course_name = htmlspecialchars($_POST["course_name"], ENT_QUOTES);
        $hoshi = htmlspecialchars($_POST["hoshi"], ENT_QUOTES);
        $day1 = htmlspecialchars($_POST["day1"], ENT_QUOTES);
        $days = htmlspecialchars($_POST["days"], ENT_QUOTES);
        $location = htmlspecialchars($_POST["location"], ENT_QUOTES);
        $inst_name = htmlspecialchars($_POST["inst_name"], ENT_QUOTES);
        $start_time = htmlspecialchars($_POST["start_time"], ENT_QUOTES);
        $finish_time = htmlspecialchars($_POST["finish_time"], ENT_QUOTES);
        $note = htmlspecialchars($_POST["note"], ENT_QUOTES);

        $course_date = get_days($day1,$days);
    }
else {
	echo "error";
	exit(1);
}

//----------------------------------------------------------------------
  $dsn = "mysql:host=".$DB_HOST.";dbname=".$DB_NAME.";charset=utf8";
  try {
    $pdo = new PDO($dsn,$DB_USER,$DB_PASS,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false));
  } catch (PDOException $e) {
  exit('データベース接続失敗。'.$e->getMessage());
  }
  //Entry Update----------------------------------------------------------------------
      //----------------------------------------------------------------------
      try{

        $table="schedule_tb";
        $key_column ="schedule_id"; $key_value = $current_name;
        $column0 = "schedule_id"; $column1 = "vendor"; $column2 = "course_code"; $column3= "course_name"; $column4 = "hoshi"; $column5 = "days"; $column6= "location"; $column7= "inst_name"; $column8= "start_time"; $column9= "finish_time"; $column10= "note"; $column11= "day1"; $column12= "day2"; $column13= "day3"; $column14= "day4"; $column15= "day5";
        $value0 = $schedule_id; $value1 = $vendor; $value2 = $course_code; $value3 = $course_name; $value4 = $hoshi; $value5 = $days; $value6 = $location; $value7 = $inst_name; $value8 = $start_time; $value9 = $finish_time; $value10 = $note; $value11 = $day1; $value12 = $course_date[1]; $value13 = $course_date[2]; $value14 = $course_date[3]; $value15 = $course_date[4];

        $sql = "update $table set $column0 = :$column0, $column1 = :$column1, $column2 = :$column2, $column3 = :$column3, $column4 = :$column4, $column5 = :$column5, $column6 = :$column6, $column7 = :$column7, $column8 = :$column8, $column9 = :$column9, $column10 = :$column10, $column11 = :$column11, $column12 = :$column12, $column13 = :$column13, $column14 = :$column14, $column15 = :$column15 where $key_column = :target_key";
        $stmt = $pdo -> prepare($sql);
        $params = array(":$column0" => "$value0",":$column1" => "$value1",":$column2" => "$value2",":$column3" => "$value3",":$column4" => "$value4",":$column5" => "$value5",":$column6" => "$value6",":$column7" => "$value7",":$column8" => "$value8",":$column9" => "$value9",":$column10" => "$value10",":$column11" => "$value11",":$column12" => "$value12",":$column13" => "$value13",":$column14" => "$value14",":$column15" => "$value15",":target_key" => "$key_value");

        $stmt->execute($params);
      }
      catch(PDOException $e){
        header("Location:./_edit_schedule.php",true,303);
      }

      $source_url = $_SERVER['HTTP_REFERER'];
      if(strstr($source_url,'add_schedule_page.php')==true){
        header("Location:./_edit_schedule.php",true,303);
      }
      else{
        header("Location:./_schedule.php",true,303);
      }

?>
