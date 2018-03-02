$(function() {
  <!-- ダイアログのフォーム要素取得 -->
  course_code = $( "#course_code" ),
  course_name = $( "#course_name" ),
  vendor = $( "#vendor" ),
  course_days = $( "#course_days" ),
  start_time = $( "#start_time" ),
  finish_time = $( "#finish_time" ),
  note = $( "#note" ),
  allFields = $( [] ).add( course_code ).add( course_name ).add( vendor ).add( course_days ).add( start_time).add( finish_time ).add( note ),
  tips = $( ".validateTips" );

  // ここでダイアログのオプション指定
  $( "#training-dialog-form" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 630, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });
  // ここでボタンを押した時にダイアログをOPENにしています
  $( "#reg_training" )
    .button()
    .click(function() {
      $( "#training-dialog-form" ).dialog( "open" );
  });
  $( "#training-dialog-form-del" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 220, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });
  $( "#del_training" )
    .button()
    .click(function() {
      $( "#training-dialog-form-del" ).dialog( "open" );
  });
});
