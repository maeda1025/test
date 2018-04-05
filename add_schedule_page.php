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
  <script src="./js/jquery-ui.min.js"></script>
  <script src="./js/edit_schedule.js"></script>
  <!-- ---------------------------------------------------------------------- -->

    <?php
    //検証用---------------------------------------
      include("C:/Users/maeda/Documents/GitHub/test/parameter_local.php");
  		include("C:/Users/maeda/Documents/GitHub/test/functions_db.php");
    //--------------------------------------------
      // include("./functions_db.php");
      // include("./function_dialog.php");
  	?>
  </head>

  <body>
      <div id="menue"></div>

    <?php
    if(empty($_GET["course_name"])){
      $schedule_id = $_GET["schedule_id"];
      $vendor = $_GET["vendor"];
      $course_code = $_GET["course_code"];
      $course_name = $_GET["course_name"];
      $hoshi = $_GET["hoshi"];
      $day1 = $_GET["day1"];
      $days = $_GET["days"];
      $location = $_GET["location"];
      $inst_name = $_GET["inst_name"];
      $start_time = $_GET["start_time"];
      $finish_time = $_GET["finish_time"];
      $note = $_GET["note"];
    }
    else{
      $schedule_id = $_GET["schedule_id"];
      $vendor = $_GET["vendor"];
      $course_code = $_GET["course_code"];
      $course_name = $_GET["course_name"];
      $hoshi = $_GET["hoshi"];
      $day1 = $_GET["day1"];
      $days = $_GET["days"];
      $location = $_GET["location"];
      $inst_name = $_GET["inst_name"];
      $start_time = $_GET["start_time"];
      $finish_time = $_GET["finish_time"];
      $note = $_GET["note"];
    }

    $pdo= connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
    $next_incremental_id = next_id($pdo,'schedule_tb','schedule_id');


    echo '<div title="トレーニング登録">';
    //以下Insert
    if($schedule_id == $next_incremental_id){
      // echo "Insert";
            echo '<form method="post" action="./insert_schedule.php" id="jquery-ui-dialog">';
            echo '<ul style="list-style:none;">';
    }
    //以下Update
    else{
      // echo "Update";
            echo '<form method="post" action="./update_schedule.php" id="jquery-ui-dialog">';
            echo '<ul style="list-style:none;">';
            echo '<input type="hidden" name="current_name" value="'.$schedule_id.'" class="input_table">';
    }
    ?>

        <li><label for="schedule_id">Schedule_ID：</label>
        <input type="text" name="schedule_id" id="schedule_id" value="<?php echo $schedule_id; ?>" class="text ui-widget-content ui-corner-all" /></li>
        <li><label id="label_vendor" for="vendor">ベンダー名：</label><button type='button' id='custom_vendor'>Custom</button>
          <?php display_list_distinct($pdo,"training_tb","vendor","vendor",$vendor); ?>
          <script>
            $(function(){
              $('#custom_vendor').click(function(){
                var node1 = document.getElementById('vendor');
                var node2 = document.getElementById('custom_vendor');
                if(node1 != null){
                	node1.parentNode.removeChild(node1);
                  node2.parentNode.removeChild(node2);
                  $('#label_vendor').after('<button type="button" id="select_vendor" onClick="window.location.reload();">Reload</button>');
                  $('#select_vendor').after('<input type="text" name="vendor" id="vendor" value="" class="text ui-widget-content ui-corner-all"/>');
                }
              });
            });
          </script>
          <script>
            $(function(){
              $('#vendor').change(function() {
                $('#course_code').empty();
                //選択したvalue値を変数に格納
                var val = $(this).val();
                var column = "vendor";
                var next_column = "course_code";
                $.ajax({
                    url : "./change_option.php",
                    type : "POST",
                    data : {post_data_1:val,post_data_2:column,post_data_3:next_column}
                }).done(function(response, textStatus, xhr) {
                  console.log("ajax通信に成功しました");
                      $('#course_code').append('<option value="">Select Something</option>');
                    $.each(response, function(index, element){
                      $('#course_code').append('<option value="'+element+'">'+element+'</option>');
                    });
                 }).fail(function(xhr, textStatus, errorThrown) {
                  console.log("ajax通信に失敗しました");
                });

              });
            });
          </script>
        </li>
        <li><label id="label_course_code" for="course_code">コースコード：</label><button type='button' id='custom_course_code'>Custom</button>
          <?php display_list_ajax($pdo,"training_tb","course_code","course_code","vendor",$vendor,$course_code); ?>
          <script>
            $(function(){
              $('#custom_course_code').click(function(){
                var node1 = document.getElementById('course_code');
                var node2 = document.getElementById('custom_course_code');
                if(node1 != null){
                	node1.parentNode.removeChild(node1);
                  node2.parentNode.removeChild(node2);
                  $('#label_course_code').after('<button type="button" id="select_course_code" onClick="window.location.reload();">Reload</button>');
                  $('#select_course_code').after('<input type="text" name="course_code" id="course_code" value="" class="text ui-widget-content ui-corner-all"/>');
                }
              });
            });
          </script>
          <script>
            $(function(){
              // if(!(document.getElementById('course_code').value)){
              $('#course_code').change(function() {
                $('#course_name').empty();
                //選択したvalue値を変数に格納
                var val = $(this).val();
                var column = "course_code";
                var next_column = "course_name";
                $.ajax({
                    url : "./change_option.php",
                    type : "POST",
                    data : {post_data_1:val,post_data_2:column,post_data_3:next_column}
                }).done(function(response, textStatus, xhr) {
                  console.log("ajax通信に成功しました");
                    $.each(response, function(index, element){
                      $('#course_name').append('<option value="'+element+'">'+element+'</option>');
                    });
                 }).fail(function(xhr, textStatus, errorThrown) {
                  console.log("ajax通信に失敗しました");
                });

              });
            });
          </script>
        </li>
        <li><label id="label_course_name" for="course_name">コース名：</label><button type='button' id='custom_course_name'>Custom</button>
          <?php display_list_ajax($pdo,"training_tb","course_name","course_name","course_code",$course_code,$course_name); ?>
          <script>
            $(function(){
              $('#custom_course_name').click(function(){
                var node1 = document.getElementById('course_name');
                var node2 = document.getElementById('custom_course_name');
                if(node1 != null){
                  node1.parentNode.removeChild(node1);
                  node2.parentNode.removeChild(node2);
                  $('#label_course_name').after('<button type="button" id="select_course_name" onClick="window.location.reload();">Reload</button>');
                  $('#select_course_name').after('<input type="text" name="course_name" id="course_name" value="" class="text ui-widget-content ui-corner-all"/>');
                }
              });

              $('form').on('submit',function(){
                var vendor = $('#vendor').val();
                var course_code =$('#course_code').val();
                var course_name = $('#course_name').val();

                if(vendor===''){
                  alert('ベンダー名を選択/入力してください。');
                  return false;
                }
                if(course_code ===''){
                  alert('コースコードを選択/入力してください。');
                  return false;
                }
                if(course_name ===''){
                  alert('コース名を選択/入力してください。');
                  return false;
                }
              });

            });
          </script>
        <li><label for="hoshi">★：</label>
          <select name="hoshi" id="hoshi" class="text ui-widget-content ui-corner-all">
            <?php
              if($hoshi == "★"){
                echo "<option selected>$hoshi</option>";
                echo "<option>　</option>";
              }
              elseif($hoshi == "　"){
                echo "<option selected>$hoshi</option>";
                echo "<option>★</option>";
              }
              else{
                echo "<option>★</option>";
                echo "<option>　</option>";
              }
            echo "</select>";
             ?>
        </li>
        <li><label for="day1">開始日：</label>
        <input type="text" id="day1" name="day1" value="<?php echo $day1; ?>" class="text ui-widget-content ui-corner-all" placeholder=" Click Here " /></li>
        <script>
         $(function(){
           $('#day1').datepicker(
             { dateFormat: 'yy/mm/dd', numberOfMonths:3, showOtherMonths: true}
           );
         });
        </script>
        <li><label for="days">日数：</label>
          <select name="days" id="days" class="text ui-widget-content ui-corner-all">
            <?php
            for($i=1;$i<=5;$i++){
              if($i == $days){
                echo "<option selected>$days</option>";
              }
              else{
                echo "<option>$i</option>";
              }
            }
            echo "</select>";
             ?>
        </li>
        <li>
          <label for="location">教室：</label>
          <?php display_list($pdo,"location_tb","location","location",$location); ?>
        </li>
        <li><label for="inst_name">講師：</label>
          <?php display_list($pdo,"inst_tb","inst_name","inst_name",$inst_name); ?>
        </li>
        <li><label for="start_time">開始時間：</label>
          <?php display_list_selected($pdo,"time_tb","time","start_time",$start_time,"09:30:00"); ?>
        <li><label for="finish_time">終了時間：</label>
          <?php display_list_selected($pdo,"time_tb","time","finish_time",$finish_time,"17:30:00"); ?>
        <li><label for="note">備考欄：</label>
        <input type="text" name="note" id="note" value="<?php echo $note; ?>" class="text ui-widget-content ui-corner-all" /></li>
        <div style="float: left;" id="popup_error"></div>
        <input id="submit_button" type="submit" value="登録">
      </ul>
      </form>
    </div>

    <div id="footer"></div>
  </body>
</html>
