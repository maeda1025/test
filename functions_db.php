<?php
//PDO------------------------------------------------------------------
//月の日数取得
	function get_days_of_month($set_year,$set_month){
		if($set_year!=="" and $set_month!==""){
			$year = date($set_year); $month = date($set_month);
		}//引数がブランクでなければ、指定年月の日数取得
		else{	$year = date("Y"); $month = date("m"); }
		//引数がブランクなら現在の年月から日数取得
		$days_month = new DateTime("last day of $year-$month");
		return $days_month -> format("d");
	}

//日数配列取得
	function get_days($start_date,$days){
	 for($i=0;$i<$days;$i++){
	  $cal_days[] = date("Y-m-d", strtotime("+".$i."day",strtotime($start_date)));
	 }
	 return $cal_days;
	}

//DB接続
	function connect_db_pdo($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME){
		$dsn = "mysql:host=".$DB_HOST.";dbname=".$DB_NAME.";charset=utf8";
	  try {
	    $pdo = new PDO($dsn,$DB_USER,$DB_PASS,
	    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false));
	  } catch (PDOException $e) {
	  exit('データベース接続失敗。'.$e->getMessage());
	  }
		return $pdo;
	}

	//Table CSV Export
		function csv_export($pdo,$table){
			$file_path = "./csv/".$table."_".date('Ymd_His').".csv";
			$file_name = basename($file_path);
			$file_length = filesize($file_name);
			$export_sql = "SELECT * FROM $table";
			$export_csv_columns = get_columns_name($pdo,$table);

		 foreach( $export_csv_columns as $key => $val ){
				 $export_header[] = mb_convert_encoding($val,'UTF-8');
		 }

		 if(touch($file_path)){
		//TableないColumns出力---------------------------------------------
				 $file = new SplFileObject($file_path, "w");
				 // write csv header
				 $file->fputcsv($export_header);
		//-------------------------------------------------------
				 // query database
				 $stmt = $pdo->query($export_sql);
				 // create csv sentences
				 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					 mb_convert_variables('UTF8',$row);
					 $file->fputcsv($row);
				 }

				 header('Content-Disposition: attachment; filename="'.$file_name.'"');
				 header("Content-Length:$file_length");
				 header("Content-Type: application/octet-stream");
				 readfile ($file_path);
				 //ファイル削除
				 unlink($file_path);
		 }
		}

//Table内の値のプルダウンリスト表示
	function display_list($pdo,$table,$column,$name,$selected){
		$pdo_stmt = $pdo->query("SELECT $column FROM $table");
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
			$list_results[] = $result[$column];
		}
		echo "<select name='$name' id='$name' class='text ui-widget-content ui-corner-all'>";
		echo "<option selected value=''>Select Something</option>";
		foreach($list_results as $values){
			if($values == $selected){
				echo "<option selected value='$values'>".$values."</option>";
			}
			else{
				echo "<option value='$values'>".$values."</option>";
			}
		}
		echo "</select>";
	}

//Table内の値のプルダウンリスト表示(DefaultのSelected指定)
	function display_list_selected($pdo,$table,$column,$name,$selected,$default){
		$pdo_stmt = $pdo->query("SELECT $column FROM $table");
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
			$list_results[] = $result[$column];
		}
		echo "<select name='$name' id='$name' class='text ui-widget-content ui-corner-all'>";
		echo "<option selected value='$default'>$default</option>";
		foreach($list_results as $values){
			if($values == $selected){
				echo "<option selected value='$values'>".$values."</option>";
			}
			else{
				echo "<option value='$values'>".$values."</option>";
			}
		}
		echo "</select>";
	}

//Table内の値のプルダウンリスト表示(重複排除)
	function display_list_distinct($pdo,$table,$column,$name,$selected){
		$pdo_stmt = $pdo->query("SELECT DISTINCT $column FROM $table");
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
			$list_results[] = $result[$column];
		}
		echo "<select name='$name' id='$name' class='text ui-widget-content ui-corner-all'>";
			if($selected === ""){
				echo "<option selected value=''>Select Something</option>";
			}
		foreach($list_results as $values){
			if($values == $selected){
				echo "<option selected value='$values'>".$values."</option>";
			}
			else{
				echo "<option value='$values'>".$values."</option>";
			}
		}
		echo "</select>";
	}

	//Table内の値のプルダウンリスト表示（ajax）
		function display_list_ajax($pdo,$table,$column,$name,$key,$where,$value){
			$pdo_stmt = $pdo->query("SELECT $column FROM $table WHERE $key='$where'");
			while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
				$list_results[] = $result[$column];
			}
			echo "<select name='$name' id='$name' class='text ui-widget-content ui-corner-all'>";
			if($value!==""){
				echo "<option value='$value'>$value</option>";
			}
			else{
				echo "<option value=''>Select Something</option>";
			}
			foreach($list_results as $values){
				if($values!==$value){
					echo "<option value='$values'>".$values."</option>";
				}
			}
			echo "</select>";
		}

//Table内の値のプルダウンリスト表示(Where指定)
	function display_list_where($pdo,$table,$column,$name,$where){
		$pdo_stmt = $pdo->query("SELECT $column FROM $table WHERE vendor='$where'");
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
			$list_results[] = $result[$column];
		}
		echo "<select name='$name' id='$name' class='text ui-widget-content ui-corner-all'>";
		foreach($list_results as $values){
				echo "<option value='$values'>".$values."</option>";
		}
		echo "</select>";
	}

//PHPによるID自動割り当ての次のID取得
	function next_id($pdo,$table,$incremental_id){
		try{
			$pdo_stmt = $pdo->query("SELECT $incremental_id FROM $table");
			$rowcount = ($pdo_stmt->rowCount());
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
		if($rowcount!==0){
			foreach ($pdo_stmt as $key => $value) {
				if($key!==0){
					if($value["$incremental_id"]-1 == $last_incremental_id){
						$last_incremental_id=$value["$incremental_id"];
						$next_incremental_id = $last_incremental_id+1;
					}
					else{
						$next_incremental_id = $last_incremental_id+1;
						break;
					}
				}
				else{
					$last_incremental_id=$value["$incremental_id"];
					$next_incremental_id = $last_incremental_id+1;
				}
			}
		}
		else{
			$next_incremental_id = 1;
		}
		return $next_incremental_id;
	}

//カラム名取得
	function get_columns_name($pdo,$table){
		$pdo_stmt = $pdo->query("SELECT * FROM $table");

		$columns = array();

		for ($i = 0; $i < $pdo_stmt->columnCount(); $i++) {
			$meta = $pdo_stmt->getColumnMeta($i);
			$columns[] = $meta['name'];
		}
		return $columns;
	}

//カラム数取得
	function get_columns_count($pdo,$table){
		$pdo_stmt = $pdo->query("SELECT * FROM $table");
		$columns_count = $pdo_stmt->columnCount();
		return $columns_count;
	}

//特定カラムのリスト取得
	function one_column_select($pdo,$table,$column){
		$pdo_stmt = $pdo -> query("SELECT $column FROM $table");
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
			$one_column_results[] = $result[$column];
		}
		return $one_column_results;
	}

//DB(Table)内全データ、Table(HTML)で表示
	function show_db_table_all($pdo,$table){
		$pdo_stmt = $pdo->query("SELECT * FROM $table");
		//Fileds表示
		 echo "</font>"."<table border='1'>";
		 // echo '<caption>'.$table.'</caption>';
		 echo '<tr>';
		//クエリ結果のカラム名取得+Table(HTML)表示----------------------------------------------------------------
		$columns=NULL;
		 for($i = 0; $i < $pdo_stmt->columnCount();$i++) {
			 $meta = $pdo_stmt->getColumnMeta($i);
			 $columns[] = $meta['name'];
		}
		foreach((array)$columns as $column_name){
			echo "<th>".$column_name."</th>";
		}
			echo "</tr>";
		//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
			echo("<tr>");
			for($n=0; $n < $pdo_stmt->columnCount(); $n++){
				echo("<td>");
				printf($result[$columns[$n]]);
				echo("</td>");
			}
			echo("</tr>");
		}
		//----------------------------------------------------------------
			echo "</table>";
	}

 //GetLog
	function get_logo($vendor_logo){
	 return '<img id="vendor_logo" src="./imgs/logo/'.$vendor_logo.'">';
	}

	//Reception_Schedule
	function reception_schedule($pdo,$table,$today){
		if($today===""){
			$today = date('Y/m/d');
		}
		//ロゴファイル一覧取得-------------------------
		$n=0;
		$dir = "./imgs/logo";
		if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
			while( ($file = readdir($handle)) !== false ) {
				$vendor_names[] = str_replace(".png","",$file);
				// $vendor_names[] = $vendor_x;
				$file_names[] = $file;
				$file_count++;
			}
		}
		//-------------------------------------------
		$columns = "vendor,course_code,day1,start_week,course_name,location";
		$where = "(day1='$today' OR day2='$today' OR day3='$today' OR day4='$today' OR day5='$today')";
		$pdo_stmt = $pdo->query("SELECT $columns FROM $table WHERE $where ORDER BY location");
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
			$list_results[] = $result;
		}

		echo "<table>";
		echo "<tr id='top_row'><th id='vendor'>ベンダー</th><th id='course_code'>コード</th><th id='start_week'></th><th id='course_name'>コース名</th><th id='location'>教室</th></tr>";

		foreach($list_results as $key => $values){
				if($values["day1"]===$today){
					if($values["start_week"]==="yes"){
						$values["start_week"] = "<font>★</font>";
					}
					elseif($values["start_week"]==="no"){
						$values["start_week"] = "<font></font>";
					}
					else{
						$values["start_week"] = "<font></font>";
					}
				}
				else{
					$values["start_week"] = "<font></font>";
				}

					if($key%2==0){ echo "<tr>"; }
					else{ echo "<tr id='even'>"; }

					// Vendorロゴ追加-----------------------------------------------------------------------------
						for($x=2;$x<=$file_count;$x++){
									 if($values["vendor"] === $vendor_names[$x]){
										 echo "<td class='vendor_logo'>"; echo get_logo($file_names[$x]); echo "</td>";
										 break;
									 }
									}
									if ($values["vendor"] !== $vendor_names[$x]) {echo "<td class='vendor_logo'>".$values["vendor"]."</td>";}

					//-------------------------------------------------------------------------------------
					echo "<td class='course_code'>".$values["course_code"]."</td><td class='start_week'>".$values["start_week"]."</td><td class='course_name'>".$values["course_name"]."</td><td class='location'>".$values["location"]."</td></tr>";
				echo "</tr>";
			}
		echo "</table>";
	}

	//Schedule_tb内全データ、Table(HTML)で表示+各行にUpdate + Deleteボタン
		function show_schedule_table_all_with_delete_botton($pdo,$table,$order_by1){
			//降順表示
				$pdo_stmt = $pdo->query("SELECT * FROM $table order by $order_by1 DESC");
			//昇順表示
				// $pdo_stmt = $pdo->query("SELECT * FROM $table order by $order_by1 ASC");
			//Fileds表示
			 echo "</font>"."<table border='1'>";
			 // echo '<caption>'.$table.'</caption>';
			 echo '<tr>';
			//クエリ結果のカラム名取得+Table(HTML)表示----------------------------------------------------------------
			$columns=NULL;
			 for($i = 0; $i < $pdo_stmt->columnCount();$i++) {
				 $meta = $pdo_stmt->getColumnMeta($i);
				 $columns[] = $meta['name'];
			}
			foreach((array)$columns as $column_name){
				echo "<th>".$column_name."</th>";
			}
				echo "<th>Upload</th><th>Delete</th>";
				echo "</tr>";
					//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
					while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
						echo("<tr>");
					//Update Fortm作成-----------------------------------------------
						printf ('<form action="./update_schedule.php" method="post">');
							echo('<input type="hidden" name="current_name" value="'.$result[$columns[0]].'" class="input_table">');
								for($n=0; $n < $pdo_stmt->columnCount(); $n++){
									echo("<td>");
									printf('<input type="text" name="'.$columns[$n].'" value="'.$result[$columns[$n]].'" class="input_table">');
									echo("</td>");
								}
						echo("<td>");
							printf ('<input type="submit" value="Update" class="input_table">');
							printf ('</form>');
						echo("</td>");
					//Delete Fortm作成-----------------------------------------------
						echo("<td>");
							printf ('<form action="./delete_schedule.php" method="post" class="form_del_inst">');
							printf ('<input type="submit" value="Delete" class="input_table">');
							printf ('<input type ="hidden" name="schedule_id" id ="schedule_id" value="'.$result[$columns[0]].'" class="input_table">');
							printf ('</form>');
						echo("</td>");
					}
				echo("</tr>");
			//----------------------------------------------------------------
				echo "</table>";
		}

	//DB(Table)内全データ、Table(HTML)で表示+各行にUpdate + Deleteボタン
		function show_db_table_all_with_delete_botton($pdo,$table,$order_by1,$order_by2){
				$pdo_stmt = $pdo->query("SELECT * FROM $table order by $order_by1,$order_by2");
			//Fileds表示
			 echo "</font>"."<table border='1'>";
			 // echo '<caption>'.$table.'</caption>';
			 echo '<tr>';
			//クエリ結果のカラム名取得+Table(HTML)表示----------------------------------------------------------------
			$columns=NULL;
			 for($i = 0; $i < $pdo_stmt->columnCount();$i++) {
				 $meta = $pdo_stmt->getColumnMeta($i);
				 $columns[] = $meta['name'];
			}
			foreach((array)$columns as $column_name){
				echo "<th>".$column_name."</th>";
			}
				echo "<th>Upload</th><th>Delete</th>";
				echo "</tr>";

				if($table==="inst_tb"){
					//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
					while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
						echo("<tr>");
					//Update Fortm作成-----------------------------------------------
						printf ('<form action="./update_inst.php" method="post">');
							echo('<input type="hidden" name="current_name" value="'.$result[$columns[0]].'" class="input_table">');
								for($n=0; $n < $pdo_stmt->columnCount(); $n++){
									echo("<td>");
									printf('<input type="text" name="'.$columns[$n].'" value="'.$result[$columns[$n]].'" class="input_table">');
									echo("</td>");
								}
						echo("<td>");
							printf ('<input type="submit" value="Update" class="input_table">');
							printf ('</form>');
						echo("</td>");
					//Delete Fortm作成-----------------------------------------------
						echo("<td>");
							printf ('<form action="./delete_inst.php" method="post" class="form_del_inst">');
							printf ('<input type="submit" value="Delete" class="input_table">');
							printf ('<input type ="hidden" name="inst_name" id ="inst_name" value="'.$result[$columns[0]].'" class="input_table">');
							printf ('</form>');
						echo("</td>");
					}
				}
				elseif($table==="location_tb"){
					//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
					while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
						echo("<tr>");
					//Update Fortm作成-----------------------------------------------
						printf ('<form action="./update_location.php" method="post">');
							echo('<input type="hidden" name="current_name" value="'.$result[$columns[0]].'" class="input_table">');
								for($n=0; $n < $pdo_stmt->columnCount(); $n++){
									echo("<td>");
									printf('<input type="text" name="'.$columns[$n].'" value="'.$result[$columns[$n]].'" class="input_table">');
									echo("</td>");
								}
						echo("<td>");
							printf ('<input type="submit" value="Update" class="input_table">');
							printf ('</form>');
						echo("</td>");
					//Delete Fortm作成-----------------------------------------------
						echo("<td>");
							printf ('<form action="./delete_location.php" method="post" class="form_del_inst">');
							printf ('<input type="submit" value="Delete" class="input_table">');
							printf ('<input type ="hidden" name="location" id ="location" value="'.$result[$columns[0]].'" class="input_table">');
							printf ('</form>');
						echo("</td>");
					}
				}
				elseif($table==="training_tb"){
					//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
					while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
						echo("<tr>");
					//Update Fortm作成-----------------------------------------------
						printf ('<form action="./update_training.php" method="post">');
							echo('<input type="hidden" name="current_name" value="'.$result[$columns[0]].'" class="input_table">');
								for($n=0; $n < $pdo_stmt->columnCount(); $n++){
									echo("<td>");
									printf('<input type="text" name="'.$columns[$n].'" value="'.$result[$columns[$n]].'" class="input_table">');
									echo("</td>");
								}
						echo("<td>");
							printf ('<input type="submit" value="Update" class="input_table">');
							printf ('</form>');
						echo("</td>");
					//Delete Fortm作成-----------------------------------------------
						echo("<td>");
							printf ('<form action="./delete_training.php" method="post" class="form_del_inst">');
							printf ('<input type="submit" value="Delete" class="input_table">');
							printf ('<input type ="hidden" name="course_code" id ="course_code" value="'.$result[$columns[0]].'" class="input_table">');
							printf ('</form>');
						echo("</td>");
					}
				}
				elseif($table==="schedule_tb"){
					//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
					while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
						echo("<tr>");
					//Update Fortm作成-----------------------------------------------
						printf ('<form action="./update_schedule.php" method="post">');
							echo('<input type="hidden" name="current_name" value="'.$result[$columns[0]].'" class="input_table">');
								for($n=0; $n < $pdo_stmt->columnCount(); $n++){
									echo("<td>");
									printf('<input type="text" name="'.$columns[$n].'" value="'.$result[$columns[$n]].'" class="input_table">');
									echo("</td>");
								}
						echo("<td>");
							printf ('<input type="submit" value="Update" class="input_table">');
							printf ('</form>');
						echo("</td>");
					//Delete Fortm作成-----------------------------------------------
						echo("<td>");
							printf ('<form action="./delete_schedule.php" method="post" class="form_del_inst">');
							printf ('<input type="submit" value="Delete" class="input_table">');
							printf ('<input type ="hidden" name="schedule_id" id ="schedule_id" value="'.$result[$columns[0]].'" class="input_table">');
							printf ('</form>');
						echo("</td>");
					}
				}
				elseif($table==="time_tb"){
					//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
					while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
						echo("<tr>");
					//Update Fortm作成-----------------------------------------------
						printf ('<form action="./update_time.php" method="post">');
									echo('<input type="hidden" name="current_name" value="'.$result[$columns[0]].'" class="input_table">');
								for($n=0; $n < $pdo_stmt->columnCount(); $n++){
									echo("<td>");
									printf('<input type="text" name="'.$columns[$n].'" value="'.$result[$columns[$n]].'" class="input_table">');
									echo("</td>");
								}
						echo("<td>");
							printf ('<input type="submit" value="Update" class="input_table">');
							printf ('</form>');
						echo("</td>");
					//Delete Fortm作成-----------------------------------------------
						echo("<td>");
							printf ('<form action="./delete_time.php" method="post" class="form_del_inst">');
							printf ('<input type="submit" value="Delete" class="input_table">');
							printf ('<input type ="hidden" name="time" id="time" value="'.$result[$columns[0]].'" class="input_table">');
							printf ('</form>');
						echo("</td>");
					}
				}
				else{

				}
				echo("</tr>");
			//----------------------------------------------------------------
				echo "</table>";
		}


//PDO------------------------------------------------------------------

//DB(Table)内、特定columnデータ表形式で表示
	function show_db_table_specific($table,$column1,$column2){
	//Fileds表示
	 $i = 0;
	 echo "</font>"."<table border='1'>";
	 echo '<caption>'.$table.'</caption>';
	 echo '<tr>';
	 echo "<th>".$column1."</th>";
	 echo "<th>".$column2."</th>";
	 echo '</tr>';

echo "SELECT ".$column1.",".$column2." FROM $table";

	 $table_data = mysql_query("SELECT ".$column1.",".$column2." FROM $table");
	 while ($data = mysql_fetch_array($table_data, MYSQL_ASSOC)) {
	     $datas[] = $data;
	 }

	 $record_count = mysql_num_rows($table_data);
	 $fields_count = mysql_num_fields($table_data);

	   foreach($datas as $data){
	     $n=0;
	     if($n%2==0){ echo '<tr>';}
	     else{ echo '<tr class="even">';}

	     for($m=0; $m<$fields_count; $m++){
	      echo "<td>".$data[$fields[$m]]."</td>";
	     }
	     echo "</tr>";
	     $n++;
	   }
	   echo "</table><br>";
	  }

//Data追加
	function insert_data($table,$column,$value){
		$sql_insert = "INSERT INTO $table ($column) VALUES ('$value') ";
		$result_flag = mysql_query($sql_insert);
	}

//Data削除
	function delete_data($table,$column,$value){
		$sql_delete = "DELETE FROM $table WHERE $column='$value'";
		$result_flag = mysql_query($sql_delete);
	}

//Data抽出
	function select_data($table,$column,$value){
		$sql_select = "SELECT * FROM $table WHERE $column='$value'";
		$result_flag = mysql_query($sql_select);
	}

//Table List入手
	function get_tables($pdo,$DB_NAME){
		$name = "Tables_in_$DB_NAME";
		$pdo_stmt = $pdo->query("SHOW TABLES");
		while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)){
			$results[] = $result;
		}
		foreach($results as $value){
			$table_results[] = $value[$name];
		}
		return $table_results;
	}

?>
