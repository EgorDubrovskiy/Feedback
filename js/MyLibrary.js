function validationArea(input, messBlock, data){
    if(data === undefined)
    {
        messBlock.html("Данные введены правильно!");
        messBlock.attr('class','valid-feedback');
        input.attr('class','valid-input');
    }
    else{
        messBlock.html(data);
        messBlock.attr('class','invalid-feedback');
        input.attr('class','invalid-input');
    }
}