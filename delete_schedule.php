<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $schedule_id = htmlspecialchars($_POST["schedule_id"], ENT_QUOTES);
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
  $column1 = "schedule_id";
  $value1 = (int)$schedule_id;

  $sql = "DELETE FROM ".$table." where $column1 = :delete1";
  $stmt = $pdo -> prepare($sql);
  $stmt->bindValue(":delete1", $value1, PDO::PARAM_STR);
  $stmt->execute();

 $source_url = $_SERVER['HTTP_REFERER'];
 if(strstr($source_url,'_schedule.php')==true){
   header("Location:./_schedule.php",true,303);
 }
 else{
   header("Location:./_edit_schedule.php",true,303);
 }

?>
