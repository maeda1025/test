<?php
include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $location = htmlspecialchars($_POST["location"], ENT_QUOTES);
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
  $column1 = "location";
  $value1 = $location;

  $sql = "DELETE FROM ".$table." where $column1 = :delete1";
  $stmt = $pdo -> prepare($sql);
  $stmt->bindValue(":delete1", $value1, PDO::PARAM_STR);
  // $stmt->bindValue(':value', 1, PDO::PARAM_INT);
  $stmt->execute();

 header("Location:./_location.php",true,303);
?>
