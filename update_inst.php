<?php
include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $current_name = htmlspecialchars($_POST["current_name"], ENT_QUOTES);
          // $inst_id = htmlspecialchars($_POST["inst_id"], ENT_QUOTES);
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
  //Entry Update----------------------------------------------------------------------
      //----------------------------------------------------------------------
      try{

        $table="inst_tb";
        $key_column ="inst_name"; $key_value = $current_name;
        $column2 = "inst_name"; $column3= "inst_team";
        $value2 = $inst_name; $value3 = $inst_team;

        $sql = "update $table set $column2 = :$column2, $column3 = :$column3 where $key_column = :target_key";
        $stmt = $pdo -> prepare($sql);
        $params = array(":$column2" => "$value2",":$column3" => "$value3",":target_key" => "$key_value");

        $stmt->execute($params);
      }
      catch(PDOException $e){
        header("Location:./_instructor.php",true,303);
      }
      //----------------------------------------------------------------------

// //単一フィールドのみ更新//------------------------------------------------
//   $sql = "update $table set team = :$column2 where inst_name = :$column1";
//   $stmt = $pdo -> prepare($sql);
//   // $params = array(':inst_name' => 'aaa', ':team' => 'bbb', ':inst_name' => '_test');
//   $stmt->bindValue(":$column1", $inst_name, PDO::PARAM_STR);
//   $stmt->bindValue(":$column2", $team, PDO::PARAM_STR);
//   // $stmt->bindValue(':value', 1, PDO::PARAM_INT);
//   $stmt->execute();
// //---------------------------------------------------------------------

 header("Location:./_instructor.php",true,303);
?>
