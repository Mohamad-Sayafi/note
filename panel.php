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
    <title>notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .note-card {
            border-radius: 1.5rem;
            padding: 1.5rem;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            transition: all 0.3s ease;
            height: 100%;
        }



        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            display: inline-block;
            z-index: 1;
        }

        .note-card:hover .delete-btn {
            display: inline-block;
        }

        .note-title {
            font-weight: 600;
            font-size: 1.2rem;
            color: #333;
        }

        .note-content {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .note-image {
            max-height: 150px;
            object-fit: cover;
            border-radius: 1rem;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
            <h2 class="fw-bold mb-3 mb-md-0">NOTES</h2>
            <div>
                <a href="notes/new.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> </a>
                <form action="logout.php" method="post" class="d-inline">
                    <button type="submit" class="btn btn-outline-secondary ms-2">Log out</button>
                </form>
            </div>
        </div>

        <div class="row g-4"><?php foreach ($notes as $note): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="note-card">


                        <a href="deletenote.php?note_id=<?= $note['note_id'] ?>" class="btn btn-sm btn-danger rounded-circle delete-btn" title="حذف یادداشت">
                            <i class="fas fa-trash-alt"></i>
                        </a>


                        <h4><?= $note['note_title'] ?></h4>
                        <p><?= $note['note_content'] ?></p>

                        <?php
                                    $photo = 'uploads/' . $note['photo_name'];
                                    if (!empty($note['photo_name']) && file_exists($photo)) {
                                        echo '<img src="' . $photo . '" class="note-image">';
                                    } else {
                                        echo '<p class="text-muted fst-italic small"> No photo set.</p>';
                                    }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>