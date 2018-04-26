<?php
  function inremental_id_insert_dialog($next_incremental_id){
    echo '<div id="dialog-form" title="講師登録">';
      echo '<form method="post" action="./insert_inst.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="inst_id"></label>';
        echo '<input type="text" name="inst_id" id="inst_id" value="'.$next_incremental_id.'" style="display: none;" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="inst_name">講師名</label>';
        echo '<input type="text" name="inst_name" id="inst_name" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="inst_team">所属</label>';
        echo '<input type="inst_team" name="inst_team" id="inst_team" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="登録">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function inst_insert_dialog(){
    echo '<div id="dialog-form" title="講師登録">';
      echo '<form method="post" action="./insert_inst.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="inst_name">講師名</label>';
        echo '<input type="text" name="inst_name" id="inst_name" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="inst_team">所属</label>';
        echo '<input type="inst_team" name="inst_team" id="inst_team" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="登録">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function inst_delete_dialog(){
    echo '<div id="dialog-form-del" title="講師削除">';
      echo '<form method="post" action="./delete_inst.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="inst_name_del">講師名</label>';
        echo '<input type="text" name="inst_name" id="inst_name" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="削除">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function location_insert_dialog(){
    echo '<div id="location-dialog-form" title="教室登録">';
      echo '<form method="post" action="./insert_location.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="location">場所名</label>';
        echo '<input type="text" name="location" id="location" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="team">チーム</label>';
        echo '<input type="text" name="team" id="team" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="sheet-counts">座席数</label>';
        echo '<input type="text" name="sheet_counts" id="sheet_counts" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="登録">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function location_delete_dialog(){
    echo '<div id="location-dialog-form-del" title="教室削除">';
      echo '<form method="post" action="./delete_location.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="location_del">場所名</label>';
        echo '<input type="text" name="location" id="location" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="削除">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function training_insert_dialog(){
    echo '<div id="training-dialog-form" title="トレーニング登録">';
      echo '<form method="post" action="./insert_training.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="training">ベンダー名</label>';
        echo '<input type="text" name="vendor" id="vendor" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="training">コースコード</label>';
        echo '<input type="text" name="course_code" id="course_code" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="training">コース名</label>';
        echo '<input type="text" name="course_name" id="course_name" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="team">日数</label>';
        echo '<input type="text" name="course_days" id="course_days" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="sheet-counts">開始時間</label>';
        echo '<input type="text" name="start_time" id="start_time" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="sheet-counts">終了時間</label>';
        echo '<input type="text" name="finish_time" id="finish_time" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="sheet-counts">備考欄</label>';
        echo '<input type="text" name="note" id="note" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="登録">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function training_delete_dialog(){
    echo '<div id="training-dialog-form-del" title="トレーニング削除">';
      echo '<form method="post" action="./delete_training.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="location_del">コースコード</label>';
        echo '<input type="text" name="course_code" id="course_code" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="削除">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function time_insert_dialog(){
    echo '<div id="time-dialog-form" title="時刻登録">';
      echo '<form method="post" action="./insert_time.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="time">時刻</label>';
        echo '<input type="text" name="time" id="time" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="登録">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function time_delete_dialog(){
    echo '<div id="time-dialog-form-del" title="時刻削除">';
      echo '<form method="post" action="./delete_time.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="time_del">時刻</label>';
        echo '<input type="text" name="time" id="time" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="削除">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function schedule_insert_dialog($next_incremental_id){
    echo '<div id="schedule-dialog-form" title="トレーニング登録">';
      echo '<form method="post" action="./insert_schedule.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="schedule_id"></label>';
        echo '<input type="text" name="schedule_id" id="schedule_id" value="'.$next_incremental_id.'" style="display: none;" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="vendor">ベンダー名</label>';
        echo '<input type="text" name="vendor" id="vendor" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="course_code">コースコード</label>';
        echo '<input type="text" name="course_code" id="course_code" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="course_name">コース名</label>';
        echo '<input type="text" name="course_name" id="course_name" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="start_week">★</label>';
        echo '<input type="text" name="start_week" id="start_week" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="day1">開始日</label>';
        echo '<input type="text" name="day1" id="day1" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="days">日数</label>';
        echo '<input type="text" name="days" id="days" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="location">教室</label>';
        echo '<input type="text" name="location" id="location" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="inst_name">講師</label>';
        echo '<input type="text" name="inst_name" id="inst_name" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="start_time">開始時間</label>';
        echo '<input type="text" name="start_time" id="start_time" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="finish_time">終了時間</label>';
        echo '<input type="text" name="finish_time" id="finish_time" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<label for="note">備考欄</label>';
        echo '<input type="text" name="note" id="note" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="登録">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

  function schedule_delete_dialog(){
    echo '<div id="schedule-dialog-form-del" title="トレーニング削除">';
      echo '<form method="post" action="./delete_schedule.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="schedule_id">スケジュールID</label>';
        echo '<input type="text" name="schedule_id" id="schedule_id" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="削除">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

 ?>
