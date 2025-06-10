<?php
if (isset($_POST['type'])) {
    $type = $_POST['type'];

    if ($type == 'register') {
        require_once './inc/register.php';
    } elseif ($type == 'login') {
        require_once './inc/login.php';
    } else {
        header('Location: index.php');
    }
}


