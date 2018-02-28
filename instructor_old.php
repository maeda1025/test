<html>

<head>
  <meta charset="utf-8">
  <title>Instructor List</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/read-html-parts.js"></script>
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
  <?php
	  $pdo= connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
    show_db_table_all($pdo,"Instructor_Table");
	?>
</body>

</html>
