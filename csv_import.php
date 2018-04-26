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

      $selected_table_imp = htmlspecialchars($_POST["selected_table_imp"], ENT_QUOTES);

      $uploadlocation ='./csv/';
      if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
        $filename = "$uploadlocation" . $_FILES["upfile"]["name"];
        if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "$filename"))
        {
          // chmod("$filename", 0644);
          echo $_FILES["upfile"]["name"] . "をアップロードしました。<br>";
        }
      }

      $file = new SplFileObject($filename);
      $file->setFlags(SplFileObject::READ_CSV);
      foreach ($file as $line) {
        //終端の空行を除く処理　空行の場合に取れる値は後述
        if(!is_null($line[0])){
          $records[] = $line;
        }
      }

       foreach ($records as $key => $values){
         if($key!==0){
           if($selected_table_imp === "inst_tb"){
             $table = $selected_table_imp;
             $column0 = "inst_name"; $column1= "inst_team";
             $value0 = $records[$key][0]; $value1 = $records[$key][1];

             $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column0,$column1) VALUES (:value0, :value1)");
             $stmt->bindValue(':value0', $value0, PDO::PARAM_STR);
             $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
             $stmt->execute();
           }
           elseif($selected_table_imp === "location_tb"){
             $table = $selected_table_imp;
             $column1 = "location"; $column2 = "team"; $column3= "sheet_counts";
             $value1 = $records[$key][0]; $value2 = $records[$key][1]; $value3 = $records[$key][2];

             $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column1,$column2,$column3) VALUES (:value1, :value2, :value3)");
             $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
             $stmt->bindValue(':value2', $value2, PDO::PARAM_STR);
             $stmt->bindValue(':value3', (int)$value3, PDO::PARAM_INT);
             $stmt->execute();
           }
           elseif($selected_table_imp === "schedule_tb"){
             $table = $selected_table_imp;
             $next_incremental_id = next_id($pdo,'schedule_tb','schedule_id');
             $column0 = "schedule_id"; $column1 = "vendor"; $column2 = "course_code"; $column3= "course_name"; $column4 = "start_week"; $column5 = "days"; $column6= "day1"; $column7= "day2"; $column8= "day3"; $column9= "day4"; $column10= "day5"; $column11= "start_time"; $column12= "finish_time"; $column13= "location"; $column14= "inst_name"; $column15= "note";
             $value0 = $next_incremental_id; $value1 = $records[$key][1]; $value2 = $records[$key][2]; $value3 = $records[$key][3]; $value4 = $records[$key][4]; $value5 = $records[$key][5]; $value6 = $records[$key][6]; $value7 = $records[$key][7]; $value8 = $records[$key][8]; $value9 = $records[$key][9]; $value10 = $records[$key][10]; $value11 = $records[$key][11]; $value12 = $records[$key][12]; $value13 = $records[$key][13]; $value14 = $records[$key][14]; $value15 = $records[$key][15];
             if($value7 === ""){ $value7 = NULL; }
             if($value6 === ""){ $value6 = NULL; }
             if($value8 === ""){ $value8 = NULL; }
             if($value9 === ""){ $value9 = NULL; }
             if($value10 === ""){ $value10 = NULL; }
             if($value15 === ""){ $value15 = NULL; }

             try{
             $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column0,$column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9,$column10,$column11,$column12,$column13,$column14,$column15) VALUES (:value0, :value1, :value2, :value3,:value4, :value5, :value6,:value7, :value8, :value9, :value10, :value11, :value12, :value13, :value14, :value15)");
             $stmt->bindValue(':value0', (int)$value0, PDO::PARAM_INT);
             $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
             $stmt->bindValue(':value2', $value2, PDO::PARAM_STR);
             $stmt->bindValue(':value3', $value3, PDO::PARAM_STR);
             $stmt->bindValue(':value4', $value4, PDO::PARAM_STR);
             $stmt->bindValue(':value5', (int)$value5, PDO::PARAM_INT);
             $stmt->bindValue(':value6', $value6, PDO::PARAM_STR);
             $stmt->bindValue(':value7', $value7, PDO::PARAM_STR);
             $stmt->bindValue(':value8', $value8, PDO::PARAM_STR);
             $stmt->bindValue(':value9', $value9, PDO::PARAM_STR);
             $stmt->bindValue(':value10', $value10, PDO::PARAM_STR);
             $stmt->bindValue(':value11', $value11, PDO::PARAM_STR);
             $stmt->bindValue(':value12', $value12, PDO::PARAM_STR);
             $stmt->bindValue(':value13', $value13, PDO::PARAM_STR);
             $stmt->bindValue(':value14', $value14, PDO::PARAM_STR);
             $stmt->bindValue(':value15', $value15, PDO::PARAM_STR);
             $stmt->execute();
            }
            catch (PDOException $e) {
              echo $e->getMessage();
              exit;
            }

           }
           elseif($selected_table_imp === "time_tb"){
             $table = $selected_table_imp;
             $column1 = "time";
             $value1 = $records[$key][0];

             $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column1) VALUES (:value1)");
             $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
             $stmt->execute();
           }
           elseif($selected_table_imp === "training_tb"){
             $table = $selected_table_imp;
             $column1 = "course_code"; $column2 = "course_name"; $column3= "vendor"; $column4 = "course_days"; $column5 = "start_time"; $column6= "finish_time"; $column7= "note";
             $value1 = $records[$key][0]; $value2 = $records[$key][2]; $value3 = $records[$key][1]; $value4 = $records[$key][3]; $value5 = $records[$key][4]; $value6 = $records[$key][5]; $value7 = $records[$key][6];

             $stmt = $pdo -> prepare("INSERT INTO ".$table." ($column1,$column2,$column3,$column4,$column5,$column6,$column7) VALUES (:value1, :value2, :value3,:value4, :value5, :value6,:value7)");
             $stmt->bindValue(':value1', $value1, PDO::PARAM_STR);
             $stmt->bindValue(':value2', $value2, PDO::PARAM_STR);
             $stmt->bindValue(':value3', $value3, PDO::PARAM_STR);
             $stmt->bindValue(':value4', (int)$value4, PDO::PARAM_INT);
             $stmt->bindValue(':value5', $value5, PDO::PARAM_STR);
             $stmt->bindValue(':value6', $value6, PDO::PARAM_STR);
             $stmt->bindValue(':value7', $value7, PDO::PARAM_STR);
             $stmt->execute();
           }
           else{
             echo "Table not selected";
           }
         }
         else{

         }
      }

    }
    else {
          echo "file not found";
    }

  ?>
