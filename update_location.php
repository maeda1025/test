<?php
include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $current_name = htmlspecialchars($_POST["current_name"], ENT_QUOTES);
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
  //Entry Update----------------------------------------------------------------------
      //----------------------------------------------------------------------
      try{

        $table="location_tb";
        $key_column ="location"; $key_value = $current_name;
        $column1 = "location"; $column2 = "team"; $column3= "sheet_counts";
        $value1 = $location; $value2 = $team; $value3 = (int)$sheet_counts;

        $sql = "update $table set $column1 = :$column1, $column2 = :$column2, $column3 = :$column3 where $key_column = :target_key";
        $stmt = $pdo -> prepare($sql);
        $params = array(":$column1" => "$value1",":$column2" => "$value2",":$column3" => "$value3",":target_key" => "$key_value");

        $stmt->execute($params);
      }
      catch(PDOException $e){
        header("Location:./_location.php",true,303);
      }
 header("Location:./_location.php",true,303);
?>
