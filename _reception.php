<html>

<head>
  <meta charset="utf-8">
  <title>JTP Education Schedule</title>
  <!-- <link rel="stylesheet" type="text/css" href="./css/common.css"> -->
  <link rel="stylesheet" type="text/css" href="./css/reception.css">
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/read-html-parts.js"></script>
  <?php
  //検証用---------------------------------------
    include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
		include("C:/Users/maeda/Documents/static/Tech/GitHub/test/functions_db.php");
    include("C:/Users/maeda/Documents/static/Tech/GitHub/test/function_dialog.php");
  //--------------------------------------------
    // include("./functions_db.php");
    // include("./function_dialog.php");
    $today ="2018/03/01";//検証用
	?>

</head>

<body>
  <!-- <h1>Education Schedule Editor</h1> -->
  <!-- <div id="menue"></div> -->
  <div id="reception_header_div"></div>
  <div id="table_title"><p>Training Information : <?php echo $today; ?></p></div>
  <p id='reception_today'><font color="red">★</font>:本日コース開始</p>
  <div id="schedule_table">
    <?php
      $pdo= connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
      reception_schedule($pdo,"schedule_tb",$today);
    ?>
  </div>

  <div id="title"><p>Notice</p></div>
  <div id="notice_div">
    <ul>
      <li>テストメッセージ01</li>
      <li>テストメッセージ02</li>
      <li>テストメッセージ03</li>
    </ul>
  </div>

  <div id="title"><p>Floor Map</p></div>
  <div id="floor_map_div">
    <span><img id="floor_map_img" src="./imgs/reception/reception_floor_map.png"></span>
  </div>

  <div id="reception_footer_div"></div>
  <!-- <div id="footer"/> -->

</body>

</html>
