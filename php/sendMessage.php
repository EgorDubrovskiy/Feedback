<?php
require_once '../controllers/MessageController.php';

//блок инициализации
$errors = "";
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$text = trim($_POST['text']);
$photo = $_FILES['photo'];

//блок валидации
if($photo['type'] != 'image/jpeg' && $photo['type'] != 'image/jpg' && $photo['type'] != 'image/png')
{
    $errors .= "Неверный формат файла (выберите файл с расширение png, jpeg, или jpg)<br>";
}
if($photo['size'] > 2097152) {
    $errors .= "Размер изображения не должен превышать 2-х мегабайт";
}
if(strlen($name) > 50) {
    $errors .= "Введите имя длинной не более 50 символов";
}
if(strlen($text) > 200) {
    $errors .= "Введите сообщение длинной не более 200 символов";
}

if($errors === "")
{
    MessageController::add($name, $email, $text, $photo);
    echo null;
}
else echo $errors;