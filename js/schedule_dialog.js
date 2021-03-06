$(function() {
  <!-- ダイアログのフォーム要素取得 -->
  schedule_id= $( "#schedule_id" ),
  vendor= $( "#vendor" ),
  course_code = $( "#course_code" ),
  course_name = $( "#course_name" ),
  hoshi = $( "#hoshi" ),
  s_day = $( "#day1" ),
  c_days = $( "#days" ),
  l_location = $( "#location" ),
  inst_name = $( "#inst_name" ),
  start_time = $( "#start_time" ),
  finish_time = $( "#finish_time" ),
  note = $( "#note" ),
  allFields = $( [] ).add( course_code ).add( course_name ).add( vendor ).add( s_day ).add( c_days ).add( start_time).add( finish_time ).add( l_location ).add( inst_name ).add( note ),
  tips = $( ".validateTips" );

  // ここでダイアログのオプション指定
  $( "#schedule-dialog-form" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 900, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });
  // ここでボタンを押した時にダイアログをOPENにしています
  $( "#reg_schedule" )
    .button()
    .click(function() {
      $("#schedule-dialog-form" ).dialog( "open" );
  });

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

});
