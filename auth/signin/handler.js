$(".authForm").submit(function( event ) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "handler.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var res = jQuery.parseJSON(data);

            //сообщение о успешной регистрации
            if(Object.keys(res).length == 0){
                document.location.href="/";
            }

            //вывод результатов валидации
            validationArea($('.authForm input[name="login"]'), $('.authForm input[name="login"]+h6'), res.login);
            validationArea($('.authForm input[name="password"]'), $('.authForm input[name="password"]+h6'), res.password);
        }
    });
});