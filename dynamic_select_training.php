<?php

  include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
  include("C:/Users/maeda/Documents/GitHub/test/functions_db.php");


  //ajax送信でPOSTされたデータを受け取る
  $post_data_1 = $_POST['post_data_1'];
  $post_data_2 = "test2";
  //受け取ったデータを配列に格納
  //そのまま返すだけだと伝わりにくいので、文字を加工して返す
  $return_array = array($post_data_1,$post_data_2);
  //ヘッダーの設定
  header('Content-type:application/json; charset=utf8');
  //「$return_array」をjson_encodeして出力
  echo json_encode($return_array);



  // connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
  //
  // $pdo_stmt = $pdo->query("SELECT course_code FROM training_tb WHERE=$vendor");
  // while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
  //   $list_results[] = $result[$column];
  // }
  // echo "<select name='$name' id='$name' class='text ui-widget-content ui-corner-all'>";
  // foreach($list_results as $values){
  //     echo "<option value='$values'>".$values."</option>";
  // }
  // echo "</select>";

 ?>