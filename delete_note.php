<?php
session_start();

if (isset($_POST['delete_note']) && isset($_POST['note_id'])) {
    $note_id = intval($_POST['note_id']);

    require_once './inc/db.php';
    $sql = "DELETE FROM usernote WHERE note_id = $note_id";
    $output = mysqli_query($connection, $sql);
}

header('Location: panel.php');
exit;