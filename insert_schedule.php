<?php
include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $schedule_id = htmlspecialchars($_POST["schedule_id"], ENT_QUOTES);
        $vendor = htmlspecialchars($_POST["vendor"], ENT_QUOTES);
        $course_code = htmlspecialchars($_POST["course_code"], ENT_QUOTES);
        $course_name = htmlspecialchars($_POST["course_name"], ENT_QUOTES);
        $hoshi = htmlspecialchars($_POST["hoshi"], ENT_QUOTES);
        $days = htmlspecialchars($_POST["days"], ENT_QUOTES);
        $location = htmlspecialchars($_POST["location"], ENT_QUOTES);
        $inst_name = htmlspecialchars($_POST["inst_name"], ENT_QUOTES);
        $start_time = htmlspecialchars($_POST["start_time"], ENT_QUOTES);
        $finish_time = htmlspecialchars($_POST["finish_time"], ENT_QUOTES);
        $note = htmlspecialchars($_POST["note"], ENT_QUOTES);
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
//----------------------------------------------------------------------
  $table="schedule_tb";
  $column0 = "schedule_id"; $column1 = "vendor"; $column2 = "course_code"; $column3= "course_name"; $column4 = "hoshi"; $column5 = "days"; $column6= "location"; $column7= "inst_name"; $column8= "start_time"; $column9= "finish_time"; $column10= "note";
  $value0 = $schedule_id; $value1 = $vendor; $value2 = $course_code; $value3 = $course_name; $value4 = $hoshi; $value5 = $days; $value6 = $location; $value7 = $inst_name; $value8 = $start_time; $value9 = $finish_time; $value10 = $note;

  $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column0,$column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9,$column10) VALUES (:value0, :value1, :value2, :value3,:value4, :value5, :value6,:value7, :value8,:value9,:value10)");
  $stmt->bindValue(':value0', (int)$value0, PDO::PARAM_INT);
  $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
  $stmt->bindValue(':value2', $value2, PDO::PARAM_STR);
  $stmt->bindValue(':value3', $value3, PDO::PARAM_STR);
  $stmt->bindValue(':value4', $value4, PDO::PARAM_STR);
  $stmt->bindValue(':value5', (int)$value5, PDO::PARAM_INT);
  $stmt->bindValue(':value6', $value6, PDO::PARAM_STR);
  $stmt->bindValue(':value7', $value7, PDO::PARAM_STR);
  $stmt->bindValue(':value8', $value8, PDO::PARAM_STR);
  $stmt->bindValue(':value9', $value9, PDO::PARAM_STR);
  $stmt->bindValue(':value10', $value10, PDO::PARAM_STR);
  $stmt->execute();

 header("Location:./_schedule.php",true,303);
?>
