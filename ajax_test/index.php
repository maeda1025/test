<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="x-ua-compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>仮のタイトル</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- <script src="http://code.jquery.com/jquery.js"></script> -->
    <script type="text/javascript" src="./main.js"></script>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
  <!-- <div id="response0">test</div> -->
  <!-- <div id="response1">test</div> -->

  <form method="post" action="./insert_schedule.php" id="jquery-ui-dialog">
  <ul style="list-style:none;">
    <li><label for="test">test：</label>
      <select name="test" id="test" class="text ui-widget-content ui-corner-all">
        <?php
            echo "<option id='test00'>Yes</option>";
            echo "<option id='test01'>No</option>";
         ?>
       </select>
       <script>
         $(function(){
           $('select').change(function() {
             //選択したvalue値を変数に格納
             var val = $(this).val();

             $.ajax({
                 url : "./ajax.php",
                 type : "POST",
                 data : {post_data_1:val}
             }).done(function(response, textStatus, xhr) {
               console.log("ajax通信に成功しました");
                 $("#course_code").text(response[0]);
                 // $("#response1").text(response[1]);

              }).fail(function(xhr, textStatus, errorThrown) {
                 console.log("ajax通信に失敗しました");
             });

           });
         });
       </script>
    </li>
    <li><label for="hoshi">★：</label>
      <select name="hoshi" id="hoshi" class="text ui-widget-content ui-corner-all">
        <?php
            echo "<option id='response0'>Yes</option>";
            echo "<option id='response1'>No</option>";
         ?>
       </select>
    </li>
  <input type="submit" value="登録">
</ul>
</form>

</body>
</html>