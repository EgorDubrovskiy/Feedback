<?php
session_start();
unset($_SESSION['AdminLogin']);

header("Location: ../index.php");

