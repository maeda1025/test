<?php
include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_code = htmlspecialchars($_POST["course_code"], ENT_QUOTES);
        $course_name = htmlspecialchars($_POST["course_name"], ENT_QUOTES);
        $vendor = htmlspecialchars($_POST["vendor"], ENT_QUOTES);
        $curse_days = htmlspecialchars($_POST["course_days"], ENT_QUOTES);
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
  $table="training_tb";
  $column1 = "course_code"; $column2 = "course_name"; $column3= "vendor"; $column4 = "course_days"; $column5 = "start_time"; $column6= "finish_time"; $column7= "note";
  $value1 = $course_code; $value2 = $course_name; $value3 = $vendor; $value4 = $curse_days; $value5 = $start_time; $value6 = $finish_time; $value7 = $note;

  $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column1,$column2,$column3,$column4,$column5,$column6,$column7) VALUES (:value1, :value2, :value3,:value4, :value5, :value6,:value7)");
  $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
  $stmt->bindValue(':value2', $value2, PDO::PARAM_STR);
  $stmt->bindValue(':value3', $value3, PDO::PARAM_STR);
  $stmt->bindValue(':value4', (int)$value4, PDO::PARAM_INT);
  $stmt->bindValue(':value5', $value5, PDO::PARAM_STR);
  $stmt->bindValue(':value6', $value6, PDO::PARAM_STR);
  $stmt->bindValue(':value7', $value7, PDO::PARAM_STR);
  $stmt->execute();

 header("Location:./_training.php",true,303);
?>
