<?php
?>
<!DOCTYPE html>
<html lang="fa">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container mt-5">
    <div class="card shadow rounded-4">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Adding new note</h4>
      </div>
      <div class="card-body">
        <form action="addnotes.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="noteTitle" class="form-label">Title</label>
            <input type="text" class="form-control" name="note_title" id="noteTitle">
          </div>
          <div class="mb-3">
            <label for="noteContent" class="form-label">Content</label>
            <textarea class="form-control" name="note_content" id="noteContent" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="noteFile" class="form-label">Choose a photo</label>
            <input type="file" class="form-control" name="photos_uplode" id="noteFile">
          </div>
          <button type="submit" name="note_submit" class="btn btn-success">Save note</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>