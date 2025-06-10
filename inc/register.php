<?php
session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm'];
$hashed = md5($pass);

if (empty($email)) {
    $_SESSION['error'] = 'Inter your email.';
    header('Location: index.php');
    exit;
}

if (empty($pass) || empty($confirm_pass)) {
    $_SESSION['error'] = 'Inter and confirm password.';
    header('Location: index.php');
    exit;
}

if ($pass !== $confirm_pass) {
    $_SESSION['error'] = 'Password is incorrect.';
    header('Location: index.php');
    exit;
} else {
    require_once 'db.php';
    $sql = "INSERT INTO Userinfo(`user_name`,`user_email`,`user_password`) VALUES('$name','$email','$hashed')";
    $output = mysqli_query($connection, $sql);
    $user_id = mysqli_insert_id($connection);
    $_SESSION['user_id'] = $user_id;


    $_SESSION['success'] = 'you registerd now login.';

    header('Location: index.php');
}
