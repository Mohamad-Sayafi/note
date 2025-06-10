<?php
session_start();
require_once 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];
$hashedpass = md5($password);

$check = mysqli_query($connection, "SELECT * FROM userinfo WHERE user_email = '$email'");
if (!$check || mysqli_num_rows($check) == 0) {
    $_SESSION['error'] = 'Invalid email or password.';
    header('Location: login.php');
    exit;
}

$user = mysqli_fetch_assoc($check);

$unhashedpass = $user['user_password'];

if ($hashedpass == $unhashedpass) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['success'] = 'Login successful.';
    header('Location: ./panel.php');
    exit;
} else {
    $_SESSION['error'] = 'Invalid email or password.';
    header('Location: login.php');
    exit;
}
