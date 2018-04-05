jQuery(function($){
    //ajax送信
    // **********************
    // URLをajax.phpにすること
    // **********************
    // $.ajax({
    //     url : "./ajax.php",
    //     type : "POST",
    //     data : {post_data_1:"hoge", post_data_2:"piyo"}
    // }).done(function(response, textStatus, xhr) {
    //     console.log("ajax通信に成功しました");
    //
    //     //responseにはajax.phpが返したレスポンスが入っている
    //
    //     // 元ページのresponse0のdivに、PHPから返されたresponse[0]を入れる
    //     $("#response0").text(response[0]);
    //
    //     // 元ページのresponse1のdivに、PHPから返されたresponse[1]を入れる
    //     $("#response1").text(response[1]);
    //
    //  }).fail(function(xhr, textStatus, errorThrown) {
    //     console.log("ajax通信に失敗しました");
    // });
});