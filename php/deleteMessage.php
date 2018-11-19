<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/MessageController.php';

MessageController::delete($_POST['id']);

echo null;