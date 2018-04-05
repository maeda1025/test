$(function(){
  <!-- ダイアログのフォーム要素取得 -->
  schedule_id= $( "#schedule_id" ),
  vendor= $( "#vendor" ),
  course_code = $( "#course_code" ),
  course_name = $( "#course_name" ),
  hoshi = $( "#hoshi" ),
  days = $( "#days" ),
  l_location = $( "#location" ),
  inst_name = $( "#inst_name" ),
  start_time = $( "#start_time" ),
  finish_time = $( "#finish_time" ),
  note = $( "#note" ),
  allFields = $( [] ).add( course_code ).add( course_name ).add( vendor ).add( course_days ).add( start_time).add( finish_time ).add( l_location ).add( inst_name ).add( note ),
  tips = $( ".validateTips" );

  // ここでダイアログのオプション指定
  $( "#schedule-dialog-form" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 848, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });

  var max_i = document.getElementById("max_i").getAttribute("value");
  for(i=0; i< max_i; i++){
    (function(){
    $("#reg_schedule"+i).on("click",function(){
        $("#schedule-dialog-form").dialog("open");
      });
    })();
  }

  $( "#schedule-dialog-form-del" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 220, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });

  $( "#del_schedule" )
    .button()
    .click(function() {
      $( "#schedule-dialog-form-del" ).dialog( "open" );
  });

  var max_d = document.getElementById("max_d").getAttribute("value");
  for(d=0; d< max_d; d++){
    (function(){
    $("#del_schedule"+d).on("click",function(){
        $("#schedule-dialog-form-del").dialog("open");
      });
    })();
  }

});
