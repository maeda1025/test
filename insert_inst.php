<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inst_name = htmlspecialchars($_POST["inst_name"], ENT_QUOTES);
        $inst_team = htmlspecialchars($_POST["inst_team"], ENT_QUOTES);
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
  $table="inst_tb";
  $column2 = "inst_name"; $column3= "inst_team";
  $value2 = $inst_name; $value3 = $inst_team;

  $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column2,$column3) VALUES (:value2, :value3)");
  $stmt->bindValue(':value2', $value2, PDO::PARAM_STR);
  $stmt->bindValue(':value3', $value3, PDO::PARAM_STR);
  // $stmt->bindValue(':value', (int)$value, PDO::PARAM_INT);
  $stmt->execute();

 header("Location:./_instructor.php",true,303);
?>
