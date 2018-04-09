<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $location = htmlspecialchars($_POST["location"], ENT_QUOTES);
        $team = htmlspecialchars($_POST["team"], ENT_QUOTES);
        $sheet_counts = htmlspecialchars($_POST["sheet_counts"], ENT_QUOTES);
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
  $table="location_tb";
  $column1 = "location"; $column2 = "team"; $column3= "sheet_counts";
  $value1 = $location; $value2 = $team; $value3 = $sheet_counts;

  $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column1,$column2,$column3) VALUES (:value1, :value2, :value3)");
  $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
  $stmt->bindValue(':value2', $value2, PDO::PARAM_STR);
  $stmt->bindValue(':value3', (int)$value3, PDO::PARAM_INT);
  // $stmt->bindValue(':value', (int)$value, PDO::PARAM_INT);
  $stmt->execute();

 header("Location:./_location.php",true,303);
?>
