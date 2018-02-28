<html>

<head>
  <meta charset="utf-8">
  <title>Instructor List</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/read-html-parts.js"></script>
<!-- inst_add_dialog用------------------------------------------------------ -->
<!-- <script src="./js/jquery-3.3.1.min.js"></script> -->
<link rel="stylesheet" href="./css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="./css/dialog.css" type="text/css" />
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/db_dialog_post.js"></script>

<!-- ---------------------------------------------------------------------- -->

  <?php
  //検証用---------------------------------------
    include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
		include("C:/Users/maeda/Documents/GitHub/test/functions_db.php");
  //--------------------------------------------
    // include("./functions_db.php");
	?>
</head>

<body>
  <!-- <h1>Instructor List</h1> -->
  <div id="menue"></div>
<div class="table_all">
    <div id="table">
    <?php
      $pdo= connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
      show_db_table_all_with_delete_botton($pdo,"inst_tb");
    ?>
  </div>

  <?php
// 次回inst_idの割り出し
$next_inst_id;
    $table="inst_tb";
    $pdo_stmt = $pdo->query("SELECT inst_id FROM $table");
      foreach ($pdo_stmt as $key => $value) {
        // var_dump($value);
        if($key!==0){
          if($value["inst_id"]-1 == $last_inst_id){
            $last_inst_id=$value["inst_id"];
          }
          else{
            $next_inst_id = $last_inst_id+1;
            // echo ("次回のID: ".$next_inst_id);
            // echo "\n";
            break;
          }
        }
        else{
          $last_inst_id=$value["inst_id"];
          $next_inst_id=$value["inst_id"];
        }
      }
   ?>

  <div id="dialog-form" title="講師登録">
  	<form method="post" action="./post_inst.php" id="jquery-ui-dialog">
  	<fieldset>
      <label for="inst_id"></label>
  		<input type="text" name="inst_id" id="inst_id" value="<?php echo $next_inst_id; ?>" style="display: none;" class="text ui-widget-content ui-corner-all" />
  		<label for="inst_name">講師名</label>
  		<input type="text" name="inst_name" id="inst_name" value="" class="text ui-widget-content ui-corner-all" />
  		<label for="inst_team">所属</label>
  		<input type="inst_team" name="inst_team" id="inst_team" value="" class="text ui-widget-content ui-corner-all" />
  		<input type="submit" value="登録">
  	</fieldset>
  	</form>
  </div>

  <div id="dialog-form-del" title="講師削除">
    <form method="post" action="./delete_inst.php" id="jquery-ui-dialog">
    <fieldset>
      <label for="inst_name_del">講師名</label>
      <input type="text" name="inst_name_del" id="inst_name_del" value="" class="text ui-widget-content ui-corner-all" />
      <input type="submit" value="削除">
    </fieldset>
    </form>
  </div>

  <div class="botton_set">
    <button id="reg_inst"><b>+</b></button>
    <button id="del_inst"><b>×</b></button>
  </div>

</div>

<?php  echo '<br>';echo'<br>';echo '<br>';echo $next_inst_id; ?>

</body>

</html>
