<?php
include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
require_once 'functions_db.php';
//----------------------------------------------------------
//POST受け取り用
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inst_name = htmlspecialchars($_POST["inst_name"], ENT_QUOTES);
        $team = htmlspecialchars($_POST["team"], ENT_QUOTES);

        echo $inst_name;
        echo $team;
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
  $column1 = "inst_name"; $column2= "team";

  $sql = "update $table set team = :update2 where inst_name = :update1";
  $stmt = $pdo -> prepare($sql);
  // $params = array(':inst_name' => 'aaa', ':team' => 'bbb', ':inst_name' => '_test');
  $stmt->bindValue(":update1", $inst_name, PDO::PARAM_STR);
  $stmt->bindValue(":update2", $team, PDO::PARAM_STR);
  // $stmt->bindValue(':value', 1, PDO::PARAM_INT);
  $stmt->execute();

// //単一フィールドのみ更新//------------------------------------------------
//   $sql = "update $table set team = :$column2 where inst_name = :$column1";
//   $stmt = $pdo -> prepare($sql);
//   // $params = array(':inst_name' => 'aaa', ':team' => 'bbb', ':inst_name' => '_test');
//   $stmt->bindValue(":$column1", $inst_name, PDO::PARAM_STR);
//   $stmt->bindValue(":$column2", $team, PDO::PARAM_STR);
//   // $stmt->bindValue(':value', 1, PDO::PARAM_INT);
//   $stmt->execute();
// //---------------------------------------------------------------------

 header("Location:./instructor.php",true,303);
?>
