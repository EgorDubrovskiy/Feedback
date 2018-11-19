$(".feedbackForm").submit(function( event ) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "php/sendMessage.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $('.messageBlock').html(data);
            if(data == "") {
                location.reload();
            }
        }
    });
});

$(".sortBy").change(function() {
    var value = $(this).find('option:selected').attr("name");
    location.href = 'http://'+window.location.hostname+'?By='+value;
});

$(".feedback .delete").click(function() {
    var feedback = $(this).parent('.feedback');
    var id = feedback.attr('id');
    $.ajax({
        type: "POST",
        url: "php/deleteMessage.php",
        data: {id: id},
        success: function (data) {
            feedback.remove();
        }
    });
});