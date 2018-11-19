<?php 
require_once 'controllers/AdminController.php'; 
require_once 'controllers/MessageController.php';

$messages;
if(isset($_GET['By'])) $messages = MessageController::get($_GET['By']);
else $messages = MessageController::get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="authInfoContainer">
        <?php if(AdminController::isAuth() == false): ?>
            <a href="auth/signin">Вход</a>
        <?php else : ?>
            Hello <?php echo $_SESSION['AdminLogin']; ?>
            <a href="auth/logout.php">Выйти</a>
        <?php endif; ?>
    </div>
    <div class="feedbackContainer">
        <?php if(count($messages) > 0): ?>
            <select class="sortBy">
                <option name="date" <?php if($_GET['By'] == "date") echo "selected" ?>>Дата</option>
                <option name="email" <?php if($_GET['By'] == "email") echo "selected" ?>>Email</option>
                <option name="name" <?php if($_GET['By'] == "name") echo "selected" ?>>Имя</option>
            </select>
        <?php endif; ?>
        <div class="feedbacks">
        <?php
        foreach ($messages as $message): ?>
            <div class="feedback" id="<?php echo $message['id']; ?>">
                    <?php if(AdminController::isAuth() == true): ?>
                        <div class="delete">удалить</div>
                    <?php endif; ?>
                    <div class="PeopleInfo">
                        <span class="RightBlock">
                            <span class="email"><?php echo $message['email']; ?></span>
                            <span class="date"><?php echo $message['date']->format('Y-m-d H:i'); ?></span>
                        </span>
                    </div>
                    <div class="mainInfo">
                        <div class="centerBlock">
                            <div class="leftBlock">
                                <div class="name"><?php echo $message['name']; ?></div>
                                <img src="<?php echo '/ImgMess/'.$message['photo']; ?>" alt="">
                            </div>
                            <div class="text"><?php echo $message['text']; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        </div>
        <form class="feedbackForm">
            <label>Имя</label>
            <input type="text" maxlength="50" name="name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Сообщение</label>
            <textarea name="text" required></textarea>

            <label>Фото</label>
            <input type="file" name="photo" required>

            <input type="submit" value="Отправить">
        </form>
        <div class="messageBlock"></div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/handler.js"></script>
</body>
</html>