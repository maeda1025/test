<html>

<head>
  <meta charset="utf-8">
  <title>Training List</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/read-html-parts.js"></script>
<!-- inst_add_dialog用------------------------------------------------------ -->
<!-- <script src="./js/jquery-3.3.1.min.js"></script> -->
<link rel="stylesheet" href="./css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="./css/dialog.css" type="text/css" />
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/training_dialog.js"></script>
<!-- ---------------------------------------------------------------------- -->

  <?php
  //検証用---------------------------------------
    include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
		include("C:/Users/maeda/Documents/static/Tech/GitHub/test/functions_db.php");
    include("C:/Users/maeda/Documents/static/Tech/GitHub/test/function_dialog.php");
  //--------------------------------------------
    // include("./functions_db.php");
    // include("./function_dialog.php");
	?>
</head>

<body>
  <div id="menue"></div>
  <!-- <div class="table_all"> -->

    <div class="botton_set">
      <button id="reg_training"><b>training追加</b></button>
      <button id="del_training"><b>training削除</b></button>
    </div>

    <div id="table">
    <?php
      $pdo= connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
      show_db_table_all_with_delete_botton($pdo,"training_tb","vendor","course_code");
    ?>
    </div>

    <?php
      // $next_incremental_id = next_id($pdo,'inst_tb','inst_id');
      training_insert_dialog();
      training_delete_dialog();
      // training_insert_dialog();
      // training_delete_dialog();
    ?>

  <!-- </div> -->
  <div id="footer"></div>

</body>

</html>
