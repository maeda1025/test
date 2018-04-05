$(function() {
  <!-- ダイアログのフォーム要素取得 -->
  t_time = $( "#time" ),
  allFields = $( [] ).add( t_time ),
  tips = $( ".validateTips" );

  // ここでダイアログのオプション指定
  $( "#time-dialog-form" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 220, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });
  // ここでボタンを押した時にダイアログをOPENにしています
  $( "#reg_time" )
    .button()
    .click(function() {
      $( "#time-dialog-form" ).dialog( "open" );
  });
  $( "#time-dialog-form-del" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 220, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });
  $( "#del_time" )
    .button()
    .click(function() {
      $( "#time-dialog-form-del" ).dialog( "open" );
  });
});
