<?php
include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $current_name = htmlspecialchars($_POST["current_name"], ENT_QUOTES);
          $time = htmlspecialchars($_POST["time"], ENT_QUOTES);
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

        $table="time_tb";
        $key_column ="time"; $key_value = $current_name;
        $column1 = "time";
        $value1 = $time;

        $sql = "update $table set $column1 = :$column1 where $key_column = :target_key";
        $stmt = $pdo -> prepare($sql);
        $params = array(":$column1" => "$value1",":target_key" => "$key_value");

        $stmt->execute($params);
      }
      catch(PDOException $e){
        header("Location:./_time.php",true,303);
      }
 header("Location:./_time.php",true,303);
?>
