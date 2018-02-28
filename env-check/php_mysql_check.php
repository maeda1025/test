<?php
//----------------------------------------------------------------------
  include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
//----------------------------------------------------------------------
  $dsn = "mysql:host=".$DB_HOST.";dbname=".$DB_NAME.";charset=utf8";
  try {
    $pdo = new PDO($dsn,$DB_USER,$DB_PASS,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false));
  } catch (PDOException $e) {
  exit('データベース接続失敗。'.$e->getMessage());
  }

//------------------------------------------------------------------
// $table="inst_tb";
// $pdo_stmt = $pdo->query("SELECT * FROM $table");
// while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
//   // var_dump($result);
//   foreach($result as $result_data){
//     printf($result_data);
//   }
// }
// // var_dump($result_data);
// foreach($result_data as $value){
//   print($value["inst_name"]);
//   print($value["team"]);
//   // print("\n");
// }

//カラム名取得-----------------------------------------------------------
  // $table="inst_tb";
  // $pdo_stmt = $pdo->query("SELECT * FROM $table");
  //
  // $columns = array();
  //
  // for ($i = 0; $i < $pdo_stmt->columnCount(); $i++) {
  //   $meta = $pdo_stmt->getColumnMeta($i);
  //   $columns[] = $meta['name'];
  // }
  //
  // // var_dump($columns);
  //
  // // foreach($columns as $column_name){
  // //   printf ($column_name);
  // // }

//テーブル内データ全取得---------------------------------------------------
  // $table="inst_tb";
  // $stmt = $pdo->query("SELECT * FROM ".$table);
  // while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
  //   // var_dump($row);
  //   // foreach($row as $row_data){
  //   //   printf($row_data);
  //   // }
  // }

//Table一覧表示---------------------------------------------------
  //PDOクエリ---------------------------------------------
    // $table="inst_tb";
    // $pdo_stmt = $pdo->query("SELECT inst_id FROM $table");
  //Fileds表示
	 // echo "</font>"."<table border='1'>";
	 // echo '<caption>'.$table.'</caption>';
	 // echo '<tr>';
//クエリ結果のカラム名取得+Table(HTML)表示----------------------------------------------------------------
  // $columns=NULL;
  //  for($i = 0; $i < $pdo_stmt->columnCount();$i++) {
	// 	 $meta = $pdo_stmt->getColumnMeta($i);
	// 	 $columns[] = $meta['name'];
  // }
  // var_dump($columns);
  // foreach((array)$columns as $column_name){
  //   echo "<th>".$column_name."</th>";
  // }
  // 	echo "</tr>";
    // var_dump($columns);
//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
//   while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
//     echo("<tr>");
//     for($n=0; $n < $pdo_stmt->columnCount(); $n++){
//       echo("<td>");
//       printf($result[$columns[$n]]);
//       echo("</td>");
//     }
//     echo("</tr>");
//   }
// //----------------------------------------------------------------
    // echo "</table><br>";

//次回inst_idの割り出し----------------------------------------------------------------
// $next_inst_id=1;
$table="inst_tb";
$pdo_stmt = $pdo->query("SELECT inst_id FROM $table");
  foreach ($pdo_stmt as $key => $value) {
    var_dump($value);
    if($key!==0){
      if($value["inst_id"]-1 == $last_inst_id){
        $last_inst_id=$value["inst_id"];
      }
      else{
        $next_inst_id = $last_inst_id+1;
        echo ("次回のID: ".$next_inst_id);
        echo "\n";
        break;
      }
    }
    else{
      $last_inst_id=$value["inst_id"];
      $next_inst_id=$value["inst_id"];
    }
    echo $next_inst_id;
  }
//----------------------------------------------------------------
?>
