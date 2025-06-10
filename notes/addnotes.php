<?php
session_start();
if (isset($_POST['note_submit'])) {
    $_SESSION['title'] = $_POST['note_title'];
    $_SESSION['note_content'] = $_POST['note_content'];


    if (isset($_FILES['photos_uplode'])) {
        $temp_file = $_FILES['photos_uplode']['tmp_name'];
        $upload_dir = '../uploads/';
        $new_name = 'file' . time() . '.png';
        move_uploaded_file($temp_file,  $upload_dir . $new_name);
    }

    $titles = $_SESSION['title'];
    $contents = $_SESSION['note_content'];
    $user_id = $_SESSION['user_id'];
    $photo_name = $new_name;

    $_SESSION['photo_name'] = $photo_name;
    $_SESSION['img_url'] = $upload_dir . $new_name;

    require_once '../inc/db.php';
    $sql = "INSERT INTO usernote (note_title, note_content, user_id,photo_name) VALUES ('$titles', '$contents', '$user_id','$photo_name')";
    mysqli_query($connection, $sql);
    header('Location: ../panel.php');
}
