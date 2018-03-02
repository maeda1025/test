<?php
//PDO------------------------------------------------------------------
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

	//DB(Table)内全データ、Table(HTML)で表示+各行にUpdate + Deleteボタン
		function show_db_table_all_with_delete_botton($pdo,$table){
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
				echo "<th>Upload</th><th>Delete</th>";
				echo "</tr>";
			//クエリ結果のData取得+Table(HTML)表示---------------------------------------------------------------
			while($result = $pdo_stmt -> fetch(PDO::FETCH_ASSOC)) {
				echo("<tr>");
				//Update Fortm作成-----------------------------------------------
				printf ('<form action="./update_inst.php" method="post">');
					echo('<input type="hidden" name="current_id" value="'.$result[$columns[0]].'" class="input_table">');
				for($n=0; $n < $pdo_stmt->columnCount(); $n++){
					echo("<td>");
					printf('<input type="text" name="'.$columns[$n].'" value="'.$result[$columns[$n]].'" class="input_table">');
					echo("</td>");
				}
				echo("<td>");
					// printf ('<form action="./upload_inst.php" method="post">');
					printf ('<input type="submit" value="Update" class="input_table">');
					// printf ('<input type ="hidden" name="inst_name_up" id ="inst_name_up" value="'.$result[$columns[0]].'"">');
					printf ('</form>');
				echo("</td>");
				//Delete Fortm作成-----------------------------------------------
				echo("<td>");
					printf ('<form action="./delete_inst.php" method="post" class="form_del_inst">');
					printf ('<input type="submit" value="Delete" class="input_table">');
					printf ('<input type ="hidden" name="inst_id" id ="inst_id" value="'.$result[$columns[0]].'" class="input_table">');
					printf ('</form>');
				echo("</td>");
				echo("</tr>");
			}
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

?>
