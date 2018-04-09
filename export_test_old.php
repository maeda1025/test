<?php
include("C:/Users/maeda/Documents/static/Tech/GitHub/test/parameter_local.php");
require_once 'functions_db.php';

    $table ="time_tb";
    $file_path = "./csv/".$table."_".date('Ymd_His').".csv";
    $export_sql = "SELECT * FROM $table";

     //----------------------------------------------------------------------
       $dsn = "mysql:host=".$DB_HOST.";dbname=".$DB_NAME.";charset=utf8";
       try {
         $pdo = new PDO($dsn,$DB_USER,$DB_PASS,
         array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false));
       } catch (PDOException $e) {
       exit('データベース接続失敗。'.$e->getMessage());
       }
     //----------------------------------------------------------------------

     $file_path = "./csv/".$table."_".date('Ymd_His').".csv";
     $export_sql = "SELECT * FROM $table";
     $export_csv_columns = get_columns_name($pdo,$table);

    foreach( $export_csv_columns as $key => $val ){
        $export_header[] = mb_convert_encoding($val, 'SJIS-win', 'UTF-8');
    }

    if(touch($file_path)){
        $file = new SplFileObject($file_path, "w");
        // write csv header
        $file->fputcsv($export_header);
        // query database
        $stmt = $pdo->query($export_sql);
        // create csv sentences
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $file->fputcsv($row);
        }
        // close database connection
        $dbh = null;
    }


?>
