<?php
session_start();
require_once './inc/db.php';

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT note_id, note_title, note_content, photo_name FROM usernote WHERE user_id = $user_id";
$output = mysqli_query($connection, $sql);

$notes = [];
while ($row = mysqli_fetch_assoc($output)) {
    $notes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Notes</h1>
            <a href="notes/new.php" class="btn btn-primary">Add new note</a>

            <form action="logout.php" method="post" class="d-inline">
                <button type="submit" class="btn btn-outline-secondary ms-2">Logout</button>
            </form>
        </div>

        <?php foreach ($notes as $note): ?>
            <div class="card mb-3 shadow-sm p-3 d-flex justify-content-between align-items-start flex-row">
                <div>
                    <h4><?= $note['note_title'] ?></h4>
                    <p><?= $note['note_content'] ?></p>

                    <?php
                    $photo = 'uploads/' . $note['photo_name'];
                    if (!empty($note['photo_name']) && file_exists($photo)) {
                        echo '<img src="' . $photo . '" class="img-fluid mt-2" style="max-width:200px;">';
                    } else {
                        echo '<p class="text-muted">No photo set.</p>';
                    }
                    ?>
                </div>

                <form action="delete_note.php" method="post">
                    <input type="hidden" name="note_id" value="<?= $note['note_id'] ?>">
                    <button type="submit" name="delete_note" class="btn btn-danger ms-3" title="Delete note">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>