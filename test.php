<?php

include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/functions_db.php");


$pdo = connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
$table= "schedule_tb";
$columns_count = get_columns_count($pdo,$table);
for($i=0;$i<$columns_count;$i++){
  if($i==0){
    $value = "?";
  }
  else{
  $value = $value.",?";
  }
}

echo $columns_count;
echo $value;
 ?>
