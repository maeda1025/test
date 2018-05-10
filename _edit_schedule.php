<html>

<head>
  <meta charset="utf-8">
  <title>Schedule-Editor</title>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="./js/read-html-parts.js"></script>
<!-- inst_add_dialog用------------------------------------------------------ -->
<!-- <script src="./js/jquery-3.3.1.min.js"></script> -->
<link rel="stylesheet" href="./css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="./css/dialog.css" type="text/css" />
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/edit_schedule.js"></script>
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
            $year = htmlspecialchars($_POST["year"], ENT_QUOTES);
            $month = htmlspecialchars($_POST["month"], ENT_QUOTES);
        }
    else {
    	$year = date('Y');
      $month = date('m');
    }
    $table="schedule_tb";
    $year_minus = date('Y',strtotime('-1 year',strtotime($year)));
    $year_plus = date('Y',strtotime('+1 year',strtotime($year)));

	?>

</head>

<body>
  <div id="menue"></div>
  <!-- <div class="table_all"> -->

    <div class="botton_set">
      <!-- <button id="reg_schedule"><b>Schedule追加</b></button>
      <button id="del_schedule"><b>Schedule削除</b></button> -->
    </div>

  <div class="change_date">
    <form action="./_edit_schedule.php" method="post" value=""/>
    <select name="year">
      <option value=<?php echo $year_minus;?>><?php echo $year_minus; ?></option>
      <option value=<?php echo $year;?> selected><?php echo $year; ?></option>
      <option value=<?php echo $year_plus;?>><?php echo $year_plus; ?></option>
    </select>
    <select name="month">
      <!-- <option value=<?php echo date('m').'>'.date('m'); ?></option> -->
      <option value="<?php echo $month; ?>" selected><?php echo $month; ?></option>
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
      <option value="06">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
    </select>
    <input type="submit" value="Change" style="display: inline" class="ui-widget-content ui-corner-all"/>
    </form>
  </div>

    <div id="table">
      <?php
        $pdo= connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

        $next_incremental_id = next_id($pdo,'schedule_tb','schedule_id');

        // $year="2018"; $month="03"; $table="schedule_tb";
        $location = one_column_select($pdo,"location_tb","location");
        $days_of_month = get_days_of_month($year,$month);

        echo "<table><tr><th></th>";
          for($i=1;$i<=$days_of_month;$i++){ echo "<th>".sprintf('%02d',$i)."</th>"; }
        echo "</tr>";

          $row=1;
          foreach($location as $location_results){
            echo "<tr><td>$location_results</td>";
            for($day=1;$day<=$days_of_month;$day++){
              $line[$row][$day] = array("course_code" => NULL);
            }

              $schedule_values = array();
              $course_summary = array();

              $pdo_stmt = $pdo -> query("SELECT * FROM $table WHERE (day1 OR day2 OR day3 OR day4 OR day5 LIKE '$year-$month%') and location='$location_results'");
              while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
                $schedule_values[] = $result;
              }
              foreach($schedule_values as $key => $values){
                $course_summary[$key] = $values;
              }

              for($count=0;$count<count($schedule_values);$count++){
                $column=1;
                for($day=1;$day<=$days_of_month;$day++){
                  $days_a = sprintf('%02d',$day);
                  $id_a = new DateTime("$year-$month-$days_a");
                  $id = $id_a->format("Y-m-d");

                  if($id == $course_summary[$count]["day1"] or $id == $course_summary[$count]["day2"] or $id == $course_summary[$count]["day3"] or $id == $course_summary[$count]["day4"] or $id == $course_summary[$count]["day5"]){
                    $line[$row][$column] = array(
                      "schedule_id" => $course_summary[$count]["schedule_id"],
                      "vendor" => $course_summary[$count]["vendor"],
                      "course_code" => $course_summary[$count]["course_code"],
                      "course_name" => $course_summary[$count]["course_name"],
                      "start_week" => $course_summary[$count]["start_week"],
                      "day1" => $course_summary[$count]["day1"],
                      "days" => $course_summary[$count]["days"],
                      "location" => $course_summary[$count]["location"],
                      "inst_name" => $course_summary[$count]["inst_name"],
                      "start_time" => $course_summary[$count]["start_time"],
                      "finish_time" => $course_summary[$count]["finish_time"],
                      "note" => $course_summary[$count]["note"],
                    );
                    $column++;
                  }
                  else{ $column++; }
                }
              }
              for($day=1;$day<=$days_of_month;$day++){
                if(!empty($line[$row][$day]["schedule_id"])){
                  $url = './add_schedule_page.php?'.
                  'schedule_id='.$line[$row][$day]["schedule_id"].'&&'.
                  'vendor='.$line[$row][$day]["vendor"].'&&'.
                  'course_code='.$line[$row][$day]["course_code"].'&&'.
                  'course_name='.$line[$row][$day]["course_name"].'&&'.
                  'start_week='.$line[$row][$day]["start_week"].'&&'.
                  'day1='.$line[$row][$day]["day1"].'&&'.
                  'days='.$line[$row][$day]["days"].'&&'.
                  'location='.$line[$row][$day]["location"].'&&'.
                  'inst_name='.$line[$row][$day]["inst_name"].'&&'.
                  'start_time='.$line[$row][$day]["start_time"].'&&'.
                  'finish_time='.$line[$row][$day]["finish_time"].'&&'.
                  'note='.$line[$row][$day]["note"].'&&';
                  echo '<td><a href="'.$url.'" class="course_a">'.$line[$row][$day]["course_code"].'</a></td>';
                }
                else{
                  $url = './add_schedule_page.php?'.
                  'schedule_id='.$next_incremental_id.'&&'.
                  'vendor=&&'.
                  'course_code=&&'.
                  'course_name=&&'.
                  'start_week=&&'.
                  'day1='.$year.'/'.$month.'/'.sprintf('%02d',$day).'&&'.
                  'days=&&'.
                  'location='.$location_results.'&&'.
                  'inst_name=&&'.
                  'start_time=&&'.
                  'finish_time=&&'.
                  'note=&&';
                  echo '<td style="width:auto; height:10px;"><a href="'.$url.'" class="course_a" style="display:block; width:100%; height:100%;">'.''.'</a></td>';
                }

              }
              $row++;
          }
          echo "</tr>";
          echo "</table>";
          echo '<div id="max_i" value="'.$row.$day.'" />';
      ?>
    </div>

  </div>
  <div id="footer"></div>

</body>
</html>
