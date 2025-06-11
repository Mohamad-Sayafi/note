<?php
session_start();
require_once './inc/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['note_id'])) {
    $note_id = intval($_GET['note_id']);
    $sql = "DELETE FROM usernote WHERE note_id = $note_id";
    mysqli_query($connection, $sql);
}

header('Location: panel.php');
exit;
