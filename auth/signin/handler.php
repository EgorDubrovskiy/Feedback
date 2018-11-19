<?php
require_once '../../controllers/AdminController.php';

echo AdminController::signin($_POST['login'], $_POST['password']);