<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/functions_db.php");

//ajax送信でPOSTされたデータを受け取る
$where_value = $_POST['post_data_1'];
$where_column = $_POST['post_data_2'];
$next_column = $_POST['post_data_3'];

// connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

$dsn = "mysql:host=".$DB_HOST.";dbname=".$DB_NAME.";charset=utf8";
try {
  $pdo = new PDO($dsn,$DB_USER,$DB_PASS,
  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
exit('データベース接続失敗。'.$e->getMessage());
}

$pdo_stmt = $pdo->query("SELECT $next_column FROM training_tb WHERE $where_column='$where_value'");
while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
  $list_results[] = $result;
}
foreach($list_results as $key => $values){
  $return_results[] = $values["$next_column"];
}
//ヘッダーの設定
header('Content-type:application/json; charset=utf8');
//「$return_array」をjson_encodeして出力
echo json_encode($return_results);
// var_dump ($list_results);

?>
