$(function() {
  <!-- ダイアログのフォーム要素取得 -->
  l_name = $( "#location_name" ),
// ※locationやlocation_nameは使えない
  team = $( "#team" ),
  sheet_counts = $( "#sheet_counts" ),
  allFields = $( [] ).add( l_name ).add( team ).add( sheet_counts ),
  tips = $( ".validateTips" );

  // ここでダイアログのオプション指定
  $( "#location-dialog-form" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 350, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });
  // ここでボタンを押した時にダイアログをOPENにしています
  $( "#reg_location" )
    .button()
    .click(function() {
      $( "#location-dialog-form" ).dialog( "open" );
  });
  $( "#location-dialog-form-del" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 220, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
  });
  $( "#del_location" )
    .button()
    .click(function() {
      $( "#location-dialog-form-del" ).dialog( "open" );
  });
});
