<html>

<head>
  <meta charset="utf-8">
  <title>Export Table</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/read-html-parts.js"></script>
<!-- inst_add_dialog用------------------------------------------------------ -->
<!-- <script src="./js/jquery-3.3.1.min.js"></script> -->
<link rel="stylesheet" href="./css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="./css/dialog.css" type="text/css" />
<script src="./js/jquery-ui.min.js"></script>
<!-- ---------------------------------------------------------------------- -->

  <?php
  //検証用---------------------------------------
    include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
		include("C:/Users/maeda/Documents/static/Tech/GitHub/test/functions_db.php");
  //--------------------------------------------
    // include("./functions_db.php");
    // include("./function_dialog.php");
    $pdo = connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
    $tables = get_tables($pdo,$DB_NAME);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selected_table = htmlspecialchars($_POST["selected_table"], ENT_QUOTES);
    }else {

    }
	?>
</head>

<body>
  <div id="menue"></div>
  <!-- <div class="table_all"> -->

  <div class="change_table">
    <form action="./export_test.php" method="post" value=""/>
      <select name="selected_table">
      <?php
          foreach($tables as $value){
            echo "<option value='$value'>$value</option>";
          }
      ?>
      </select>
    <input type="submit" value="Export Table" style="display: inline" class="ui-widget-content ui-corner-all"/>
    </form>
  </div>

  <?php
    csv_export($pdo,$selected_table);
  ?>

  <!-- </div> -->
  <div id="footer"></div>

</body>

</html>
