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
            $selected_table_exp = htmlspecialchars($_POST["selected_table_exp"], ENT_QUOTES);
    }else {

    }
    csv_export($pdo,$selected_table_exp);
  ?>
