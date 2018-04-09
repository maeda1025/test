<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $course_code = htmlspecialchars($_POST["course_code"], ENT_QUOTES);
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
  $column1 = "course_code";
  $value1 = $course_code;

  $sql = "DELETE FROM ".$table." where $column1 = :delete1";
  $stmt = $pdo -> prepare($sql);
  $stmt->bindValue(":delete1", $value1, PDO::PARAM_STR);
  $stmt->execute();

 header("Location:./_training.php",true,303);
?>
