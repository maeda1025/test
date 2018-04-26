<html>

<head>
  <meta charset="utf-8">
  <title>Monitor Check</title>
  <!-- <link rel="stylesheet" type="text/css" href="./css/common.css"> -->
  <link rel="stylesheet" type="text/css" href="./css/menue.css">
  <link rel="stylesheet" type="text/css" href="./css/reception.css">
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/read-html-parts.js"></script>
<!-- inst_add_dialog用------------------------------------------------------ -->
<!-- <script src="./js/jquery-3.3.1.min.js"></script> -->
<link rel="stylesheet" href="./css/jquery-ui.min.css" type="text/css" />
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/time_dialog.js"></script>
<!-- ---------------------------------------------------------------------- -->

  <?php
  //検証用---------------------------------------
    include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
		include("C:/Users/maeda/Documents/static/Tech/GitHub/test/functions_db.php");
    include("C:/Users/maeda/Documents/static/Tech/GitHub/test/function_dialog.php");
  //--------------------------------------------
    // include("./functions_db.php");
    // include("./function_dialog.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $date = htmlspecialchars($_POST["date"], ENT_QUOTES);
        }
    else {
      $date = date("Y-m-d");
    }
	?>
</head>

<body>
  <div id="menue"></div>
  <!-- <div class="table_all"> -->
  <div id="table_title"><p>Training Information : <?php echo $date; ?></p></div>

  <div class="change_date">
    <form action="./_monitor_check.php" method="post" value=""/>
      <label for="date" style="margin-left: 3%;">開始日：</label>
      <input type="text" id="date" name="date" value="<?php echo $date; ?>" class="text ui-widget-content ui-corner-all" placeholder=" Click Here " /></li>
      <script>
       $(function(){
         $('#date').datepicker(
           { dateFormat: 'yy-mm-dd', numberOfMonths:3, showOtherMonths: true}
         );
       });
      </script>
      <input type="submit" value="Change" style="display: inline" class="ui-widget-content ui-corner-all"/>
    </form>
  </div>

  <p id='reception_today'><font color="red">★</font>:本日コース開始</p>
  <div id="schedule_table">
      <?php
        $pdo= connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
        reception_schedule($pdo,"schedule_tb",$date);
      ?>
  </div>



  <!-- </div> -->
  <div id="footer"></div>

</body>

</html>
