$(function() {
  <!-- ダイアログのフォーム要素取得 -->
  inst_name = $( "#inst_name" ),
  team = $( "#team" ),
  allFields = $( [] ).add( inst_name ).add( team ),
  tips = $( ".validateTips" );

  // function updateTips( t ) {
  //   tips
  //     .text( t )
  //     .addClass( "ui-state-highlight" );
  //   setTimeout(function() {
  //     tips.removeClass( "ui-state-highlight", 1500 );
  //   }, 500 );
  // }

  // ここでダイアログのオプション指定
  $( "#dialog-form" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 270, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
    // close: function() {
    //   allFields.val( "" ).removeClass( "ui-state-error" );
    // }
  });
  // ここでボタンを押した時にダイアログをOPENにしています
  $( "#reg_inst" )
    .button()
    .click(function() {
      $( "#dialog-form" ).dialog( "open" );
  });

  $( "#dialog-form-del" ).dialog({
    autoOpen: false, // trueにすると画面がロードされた時に自動でダイアログがオープンされます。
    height: 220, // 大きさ指定
    width: 400,
    modal: true, // モーダルダイアログ（ダイアログが開いている間は他の操作が出来ない）指定
    show: "explode", // 開く時と閉じるときのアニメーション指定です。
    hide: "explode",
    // close: function() {
    //   allFields.val( "" ).removeClass( "ui-state-error" );
    // }
  });

  $( "#del_inst" )
    .button()
    .click(function() {
      $( "#dialog-form-del" ).dialog( "open" );
  });

});
