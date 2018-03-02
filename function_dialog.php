<?php
  function inst_insert_dialog($next_incremental_id){

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

  function inst_delete_dialog(){
    echo '<div id="dialog-form-del" title="講師削除">';
      echo '<form method="post" action="./delete_inst.php" id="jquery-ui-dialog">';
      echo '<fieldset>';
        echo '<label for="inst_name_del">ID</label>';
        echo '<input type="text" name="inst_id" id="inst_id" value="" class="text ui-widget-content ui-corner-all" />';
        echo '<input type="submit" value="削除">';
      echo '</fieldset>';
      echo '</form>';
    echo '</div>';
  }

 ?>
